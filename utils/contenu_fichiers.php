<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/header.php'; ?>
<div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">

<?php
// Chemin du dossier racine du projet (à partir du répertoire où se trouve ce script)
$chemin_racine_projet = realpath(__DIR__ . "/../") . DIRECTORY_SEPARATOR;

// Nom du fichier Markdown à créer
$nom_fichier_markdown = $chemin_racine_projet . "SRC_PHP.md";

// Liste des répertoires à ignorer
$repertoires_ignores = array('.git', '.venv', '.vscode', 'demo', '@install', 'utils', '@OLD', 'assets');

// Liste des extensions de fichiers à ignorer
$extensions_ignores = array('.md', '.html', '.zip');

// Fonction récursive pour parcourir les sous-dossiers
function parcourir_dossiers($chemin_dossier, &$contenu_markdown, $chemin_racine_projet, $extensions_ignores) {
    $contenu = scandir($chemin_dossier);
    foreach ($contenu as $element) {
        if ($element != "." && $element != "..") {
            $chemin_element = $chemin_dossier . DIRECTORY_SEPARATOR . $element;
            if (is_file($chemin_element)) {
                $extension = pathinfo($chemin_element, PATHINFO_EXTENSION);
                if (!in_array($extension, $extensions_ignores)) {
                    $chemin_relatif = str_replace($chemin_racine_projet, "./", $chemin_element);
                    $chemin_relatif = str_replace('\\', '/', $chemin_relatif);
                    $contenu_markdown .= "# CHEMIN D'ACCES/NOM DU FICHIER: $chemin_relatif\n";
                    $contenu_markdown .= "# CODE SOURCE PHP\n";
                    $contenu_markdown .= file_get_contents($chemin_element);
                    $contenu_markdown .= "\n\n";
                }
            } elseif (is_dir($chemin_element)) {
                parcourir_dossiers($chemin_element, $contenu_markdown, $chemin_racine_projet, $extensions_ignores);
            }
        }
    }
}

// Vérifier si le chemin existe et est un répertoire
if (is_dir($chemin_racine_projet)) {
    // Obtenir la liste des fichiers et des répertoires
    $contenu = scandir($chemin_racine_projet);

    // Créer le contenu du fichier Markdown
    $contenu_markdown = "";
    foreach ($contenu as $element) {
        if ($element != "." && $element != ".." && !in_array($element, $repertoires_ignores)) {
            $chemin_element = $chemin_racine_projet . $element;
            if (is_file($chemin_element)) {
                $extension = pathinfo($chemin_element, PATHINFO_EXTENSION);
                if ($extension === 'php' && !in_array($extension, $extensions_ignores)) {
                    $chemin_relatif = str_replace($chemin_racine_projet, "./", $chemin_element);
                    $chemin_relatif = str_replace('\\', '/', $chemin_relatif);
                    $contenu_markdown .= "### CHEMIN D'ACCES/NOM DU FICHIER: $chemin_relatif\n";
                    $contenu_markdown .= "### CODE SOURCE PHP\n";
                    $contenu_markdown .= file_get_contents($chemin_element);
                    $contenu_markdown .= "\n\n";
                }
            } elseif (is_dir($chemin_element) && $element === 'views') {
                parcourir_dossiers($chemin_element, $contenu_markdown, $chemin_racine_projet, $extensions_ignores);
            }
        }
    }

    // Écrire le contenu dans le fichier Markdown
    if (file_put_contents($nom_fichier_markdown, $contenu_markdown) !== false) {
        echo "<p>Le fichier Markdown SRC_PHP.md a été créé avec succès.</p>\n";
    } else {
        echo "<p>Une erreur s'est produite lors de la création du fichier Markdown.</p>\n";
    }
} else {
    // Afficher un message d'erreur si le chemin n'est pas un répertoire
    echo "<p>Le chemin spécifié n'est pas un répertoire valide.</p>\n";
}
?>

          </p>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/footer.php'; ?>
