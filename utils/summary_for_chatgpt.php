<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/header.php'; ?>
<div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">

<?php

// Fonction pour lister les fichiers et répertoires de manière récursive avec dates de création et de modification
function listFilesAndDirectories($dir, &$results = [], $excludedDirs = ['.git', '.venv', '.vscode', 'demo', '@install', 'utils', '@OLD'], $depth = 0) {
    $files = scandir($dir);

    $dirs = [];
    $nonDirs = [];

    // Séparation des fichiers et des répertoires
    foreach ($files as $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (is_dir($path)) {
            if ($value != "." && $value != ".." && !in_array(basename($path), $excludedDirs)) {
                $dirs[] = $value;
            }
        } else {
            $nonDirs[] = $value;
        }
    }

    natsort($dirs);
    natsort($nonDirs);

    // Traitement des répertoires
    foreach ($dirs as $dirName) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $dirName);
        $results[] = [
            'path' => $path,
            'relative' => str_repeat('│   ', $depth) . '├── ' . $dirName . '/',
            'created' => date("Y-m-d H:i:s", filectime($path)),
            'modified' => date("Y-m-d H:i:s", filemtime($path))
        ];
        listFilesAndDirectories($path, $results, $excludedDirs, $depth + 1);
    }

    // Traitement des fichiers
    foreach ($nonDirs as $fileName) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $fileName);
        $results[] = [
            'path' => $path,
            'relative' => str_repeat('│   ', $depth) . '└── ' . $fileName,
            'created' => date("Y-m-d H:i:s", filectime($path)),
            'modified' => date("Y-m-d H:i:s", filemtime($path))
        ];


        
    }

    return $results;
}

// Fonction pour générer le contenu Markdown de la liste des fichiers avec dates de création et de modification
function generateMarkdown($baseDir, $filePaths) {
    $mdContent = "\n## Liste des fichiers du projet\n";
    $mdContent .= "```\n";
    $mdContent .= '/' . basename($baseDir) . "/\n";

    foreach ($filePaths as $filePath) {
        $mdContent .= $filePath['relative'] . "\n";
        //$mdContent .= $filePath['relative'] . " (date de création : " . $filePath['created'] . " - date de modification : " . $filePath['modified'] . ")\n";
    }

    $mdContent .= "```\n";
    return $mdContent;
}

// Fonction pour créer un fichier ZIP contenant les fichiers du projet
function createZip($baseDir, $filePaths) {
    $timestamp = date("Ymd-His");
    $zipFile = $baseDir . DIRECTORY_SEPARATOR . $timestamp . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE) !== TRUE) {
        die("Failed to create the zip file.");
    }

    foreach ($filePaths as $filePath) {
        if (!is_dir($filePath['path'])) {
            $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $filePath['path']);
            $zip->addFile($filePath['path'], $relativePath);
        }
    }

    $zip->close();

    // Retourner le nom du fichier ZIP
    return basename($zipFile);
}

// Fonction pour générer les informations de mise à jour
function generateUpdateInformation($description, $zipFileName) {
/*
    $date = date("Y-m-d");
    $time = date("H:i:s");

//    $updateInfo = "\n## Mise à Jour du Projet\n";
    $updateInfo = "## Date et Heure de la Génération\n";
    
    $updateInfo .= "- **Date** : $date\n";
    $updateInfo .= "- **Heure** : $time\n";
    $updateInfo .= "### Description des Changements\n";
    $updateInfo .= $description . "\n";
    
	$updateInfo .= "### Fichier Zip\n";
   
   $updateInfo .= "1. Extraire le contenu du fichier ZIP.\n";
    $updateInfo .= "2. Comparer la structure des fichiers avec la précédente pour identifier les nouveaux fichiers et ceux qui ont été modifiés.\n";
    $updateInfo .= "3. Mettre à jour la base de connaissances de l'assistant avec les nouveaux fichiers et les modifications apportées.\n";
    $updateInfo .= "4. Tester l'assistant pour s'assurer qu'il prend bien en compte les nouvelles modifications et qu'il fonctionne correctement avec la structure mise à jour du projet.\n";
    $updateInfo .= "5. À chaque fois qu'un fichier ZIP est téléchargé, décompressez-le, lisez le fichier README.md, et utilisez les informations pour analyser les changements et comprendre comment le projet évolue.\n";
  // Ajout du nom du fichier ZIP dans les informations de mise à jour
    $updateInfo .= "\nLe fichier ZIP contenant l'ensemble du projet est : `$zipFileName`\n";
*/
$updateInfo="";    
return $updateInfo;
	
  
}

// Fonction pour mettre à jour le README avec les liens GitHub vers les fichiers
function updateReadmeWithGithubLinks($baseDir, $filePaths) {
    $githubLinksContent = "\n## Liste des fichiers du projet accessible sur GIT\n";
    $githubLinksContent .= "```\n";
    $githubBaseUrl = "https://github.com/cslucki/extranet/blob/main/";

    foreach ($filePaths as $filePath) {
        if (!is_dir($filePath['path'])) {
            $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $filePath['path']);
            $githubLink = $githubBaseUrl . $relativePath;
            $githubLinksContent .= $githubLink . "\n";
        }
    }
    
    $githubLinksContent .= "```\n";

    // Lire le contenu actuel du README.md
    $readmePath = $baseDir . DIRECTORY_SEPARATOR . 'README.md';
    $readmeContent = file_get_contents($readmePath);

    // Insérer les liens GitHub après la liste des fichiers dans le README
    //$readmeContent = preg_replace('/## Liste des fichiers du projet\n```/', "## Liste des fichiers du projet\n```\n" . $githubLinksContent, $readmeContent);
    $readmeContent.= $githubLinksContent;
	//$readmeContent.= '## Liste des fichiers du projet';

    // Écrire le contenu mis à jour dans le fichier README
    file_put_contents($readmePath, $readmeContent);
}

// Déplacer les anciens fichiers ZIP vers le répertoire @OLD
function moveOldZips($baseDir) {
    $oldDir = $baseDir . DIRECTORY_SEPARATOR . '@OLD';
    if (!is_dir($oldDir)) {
        mkdir($oldDir, 0777, true);
    }
    $files = scandir($baseDir);
    foreach ($files as $file) {
        if (strpos($file, '.zip') !== false) {
            rename($baseDir . DIRECTORY_SEPARATOR . $file, $oldDir . DIRECTORY_SEPARATOR . $file);
        }
    }
}

// Afficher le formulaire pour saisir la description des changements
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description'])) {
    $description = $_POST['description'];

    // Définir dynamiquement le répertoire de base
    $baseDir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
    if (!is_dir($baseDir)) {
        die("The specified base directory does not exist.");
    }

    // Déplacer les anciens fichiers ZIP
    moveOldZips($baseDir);

    // Liste des fichiers et répertoires
    $filesAndDirs = listFilesAndDirectories($baseDir);

    // Générer le contenu Markdown et les informations de mise à jour
    $markdownContent = generateMarkdown($baseDir, $filesAndDirs);
    $zipFileName = createZip($baseDir, $filesAndDirs);
    $updateInfo = generateUpdateInformation($description, $zipFileName);

    // Ajouter au fichier README.md
    $readmePath = $baseDir . DIRECTORY_SEPARATOR . 'README.md';
    $file = fopen($readmePath, 'a');
    if ($file === false) {
        die("Failed to open the file README.md.");
    }
    fwrite($file, $updateInfo);
    fwrite($file, $markdownContent);
    fclose($file);

    // Mettre à jour le README.md avec les liens GitHub vers les fichiers
    updateReadmeWithGithubLinks($baseDir, $filesAndDirs);

    // Afficher le résultat pour le débogage
    echo "Debug Info:\n";
    echo "------------\n";
    echo nl2br(htmlspecialchars($updateInfo));
    echo nl2br(htmlspecialchars($markdownContent));
    echo "<br><a href=\"$zipFileName\">Download ZIP file</a>";
} else {
    // Afficher le formulaire
    echo '<form method="post">';
    echo '<label for="description">Description des Changements :</label><br>';
    echo '<textarea id="description" name="description" rows="10" cols="50" required></textarea><br>';
    echo '<input type="submit" value="Soumettre">';
    echo '</form>';
}

?>

          </p>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/footer.php'; ?>
