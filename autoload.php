<?php
spl_autoload_register(function ($class) {
    // Mapping des namespaces vers les répertoires
    $prefixes = [
        'PhpOffice\\PhpSpreadsheet\\' => __DIR__ . '/libs/PhpSpreadsheet/src/PhpSpreadsheet/',
        'Psr\\SimpleCache\\' => __DIR__ . '/libs/simple-cache/src/Cache/',
		'Smalot\\PdfParser\\' => __DIR__ . '/libs/simple-cache/src/Smalot/PdfParser/',
    ];

    // Parcourir les préfixes pour trouver le bon répertoire de base
    foreach ($prefixes as $prefix => $base_dir) {
        // Est-ce que la classe utilise ce préfixe ?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Obtenir le nom de la classe relative
        $relative_class = substr($class, $len);

        // Remplacer le préfixe de l'espace de noms par le répertoire de base,
        // remplacer les séparateurs d'espaces de noms par des séparateurs de répertoires
        // ajouter .php à la fin
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Si le fichier existe, l'inclure
        if (file_exists($file)) {
            require $file;
            return;
        } else {
            echo "Le fichier pour la classe $class n'a pas été trouvé. Chemin cherché : $file<br>";
        }
    }
});


