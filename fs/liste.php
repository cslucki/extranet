<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des enregistrements</title>
<style>
/* Styles CSS facultatifs pour la mise en page */
table {
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 8px;
    text-align: left;
}

#pagination {
    margin-top: 10px;
}

#pagination a {
    padding: 5px 10px;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    text-decoration: none;
    margin-right: 5px;
}

#pagination a:hover {
    background-color: #ddd;
}

/* Style pour cacher les détails par défaut */
.details {
    display: none;
}

/* Style pour le conteneur des détails */
#details-container {
    margin-top: 20px;
}
</style>
</head>
<body>

<?php
// Inclure la classe Yaml de la bibliothèque Symfony YAML
require 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

// Nom du fichier YAML
$filename = 'data.yaml';

// Fonction pour lire les enregistrements à partir du fichier YAML
function readRecords($filename) {
    return Yaml::parseFile($filename);
}

// Récupérer tous les enregistrements
$allRecords = readRecords($filename);

// Pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 20;
$totalRecords = count($allRecords);
$totalPages = ceil($totalRecords / $perPage);
$start = ($page - 1) * $perPage;
$end = $start + $perPage;
$records = array_slice($allRecords, $start, $perPage);

// Affichage des enregistrements
echo '<table>';
foreach ($records as $record) {
    echo '<tr>';
    foreach ($record as $key => $value) {
        if ($key === 'id') {
            // Lien pour afficher les détails
            echo '<td><a href="#" class="details-link">' . $value . '</a></td>';
        } else {
            // Affichage normal des données sauf l'ID
            echo '<td>' . $value . '</td>';
        }
    }
    echo '</tr>';
}
echo '</table>';

// Affichage de la pagination
if ($totalPages > 1) {
    echo '<div id="pagination">';
    if ($page > 1) {
        echo '<a href="?page='.($page - 1).'">Précédent</a>';
    }
    if ($page < $totalPages) {
        echo '<a href="?page='.($page + 1).'">Suivant</a>';
    }
    echo '</div>';
}
?>

<!-- Conteneur pour afficher les détails -->
<div id="details-container"></div>

<!-- Script jQuery pour afficher les détails lors du clic sur le lien -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.details-link').on('click', function(e){
        e.preventDefault();
        // Trouver le contenu de la ligne parente (tr)
        var $tr = $(this).closest('tr');
        // Trouver tous les éléments td sauf le premier (ID)
        var $tds = $tr.find('td:not(:first-child)');
        // Créer un message pour afficher les détails
        var message = '<ul>';
        $tds.each(function(){
            message += '<li>' + $(this).text() + '</li>';
        });
        message += '</ul>';
        // Afficher les détails dans le conteneur dédié
        $('#details-container').html('<h2>Détails de l\'enregistrement</h2>' + message);
    });
});
</script>

</body>
</html>
