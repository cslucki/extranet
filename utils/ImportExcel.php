<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/header.php'; ?>
<div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">


<?php require_once '../custo/config.php'; ?>
<?php require_once '../custo/functions.inc.php'; ?> 


<?php
// Activer le rapport d'erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure l'autoloader personnalisé
require '../autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

$action = $_GET['action'] ?? $_POST['action'] ?? 'upload_excel';

////////////////////////////////
// Action = upload_excel
///////////////////////////
if ($action === "upload_excel") {
    echo "
    <p>Le fichier Excel doit contenir les colonnes suivantes :</p>
    <ul>
        <li>Colonne A : id_formation_dossiers</li>
        <li>Colonne D : Login (login)</li>
        <li>Colonne E : Numéro de formation dans le catalogue (id_formation_catalogue)</li>
        <li>Colonne F : Date de début de formation (date_debut_formation)</li>
        <li>Colonne G : Date de fin de formation (date_fin_formation)</li>
        <li>Colonne H : Date de prise en charge (date_pec)</li>
        <li>Colonne I : Numéro de PEC (pec_numero)</li>
        <li>Colonne J : id_menustatutformation qui est à 11</li>
    </ul>
    <form method='post' enctype='multipart/form-data'>
        <input type='hidden' name='action' value='process_excel'>
        <input type='file' name='excel_file'>
        <input type='submit' value='Télécharger'>
    </form>
    ";
}

////////////////////////////////
// Action = process_excel
///////////////////////////
if ($action === "process_excel") {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === 0) {
        $file = $_FILES['excel_file']['tmp_name'];

        // Vérifier où le fichier est placé
        echo "<p>Chemin du fichier téléchargé : $file</p>";

        try {
            // Lecture du fichier Excel avec PhpSpreadsheet
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();

            // Parcourir les lignes du fichier Excel à partir de la 2ème ligne (en supposant que la première ligne est l'en-tête)
            foreach ($sheet->getRowIterator(2) as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Vérifier que toutes les clés nécessaires sont définies
                $id_formation_dossiers = $data[0] ?? null; // Colonne A
                $login = $data[3] ?? null; // Colonne D
                $numero_formation = $data[4] ?? null; // Colonne E
                $date_debut_formation = isset($data[5]) && is_numeric($data[5]) ? date('Y-m-d', Date::excelToTimestamp($data[5])) : null; // Colonne F
                $date_fin_formation = isset($data[6]) && is_numeric($data[6]) ? date('Y-m-d', Date::excelToTimestamp($data[6])) : null; // Colonne G
                $date_pec = isset($data[7]) && is_numeric($data[7]) ? date('Y-m-d', Date::excelToTimestamp($data[7])) : null; // Colonne H
                $pec_numero = $data[8] ?? null; // Colonne I
                $id_menustatutformation = 11; // Colonne J (fixe)

                // Récupérer l'id_formation_catalogue à partir du numéro de formation
                $id_formation_catalogue = db_extract_unique_data('formation_catalogue', 'id_formation_catalogue', 'numero', $numero_formation);

                if ($id_formation_catalogue === 0) {
                    echo "<font color=red>Numéro de formation $numero_formation introuvable.</font><br>";
                    continue;
                }

                if (!empty($id_formation_dossiers)) {
                    // Vérifier si le dossier de formation existe déjà
                    $query_check = "SELECT COUNT(*) FROM formation_dossiers WHERE id_formation_dossiers = :id_formation_dossiers";
                    $stmt_check = $pdo->prepare($query_check);
                    $stmt_check->execute(['id_formation_dossiers' => $id_formation_dossiers]);
                    $exists = $stmt_check->fetchColumn();

                    if ($exists) {
                        echo "Le dossier de formation avec id $id_formation_dossiers existe déjà.<br>";
                        continue;
                    }
                }

                if (!empty($login) && !empty($id_formation_catalogue)) {
                    // Récupérer l'id_guid à partir du login
                    $query_user = "SELECT id_guid FROM user WHERE login = :login";
                    $stmt_user = $pdo->prepare($query_user);
                    $stmt_user->execute(['login' => $login]);
                    
                    // Afficher la requête pour débogage
                    //echo "<pre>Requête SQL Utilisateur: " . $query_user . " avec login = " . $login . "</pre>";

                    if ($row_user = $stmt_user->fetch()) {
                        $id_guid = $row_user['id_guid'];

                        // Afficher la requête pour débogage
                        echo "<pre>Utilisateur trouvé: id_guid = " . $id_guid . "</pre>";

                        // Insérer les données dans la table formation_dossiers
                        $query_insert = "INSERT INTO formation_dossiers (
                            id_formation_dossiers,
                            id_guid, 
                            id_formation_catalogue, 
                            id_menustatutformation, 
                            date_devis, 
                            date_debut_formation, 
                            date_fin_formation, 
                            date_pec, 
                            pec_numero
                        ) VALUES (
                            :id_formation_dossiers,
                            :id_guid, 
                            :id_formation_catalogue, 
                            :id_menustatutformation, 
                            NOW(), 
                            :date_debut_formation, 
                            :date_fin_formation, 
                            :date_pec, 
                            :pec_numero
                        )";

                        $stmt_insert = $pdo->prepare($query_insert);
                        $stmt_insert->execute([
                            'id_formation_dossiers' => $id_formation_dossiers,
                            'id_guid' => $id_guid,
                            'id_formation_catalogue' => $id_formation_catalogue,
                            'id_menustatutformation' => $id_menustatutformation,
                            'date_debut_formation' => $date_debut_formation,
                            'date_fin_formation' => $date_fin_formation,
                            'date_pec' => $date_pec,
                            'pec_numero' => $pec_numero,
                        ]);

                        // Afficher la requête pour débogage
                        //echo "<pre>Requête SQL Insertion: " . $query_insert . " avec paramètres : id_formation_dossiers = " . $id_formation_dossiers . ", id_guid = " . $id_guid . ", id_formation_catalogue = " . $id_formation_catalogue . ", date_debut_formation = " . $date_debut_formation . ", date_fin_formation = " . $date_fin_formation . ", date_pec = " . $date_pec . ", pec_numero = " . $pec_numero . "</pre>";

                        echo "Dossier créé pour le login $login avec la formation $id_formation_catalogue.<br>";
                    } else {
                        echo "<font color=red>$id_formation_dossiers - Utilisateur avec login $login introuvable.</font><br>";
                    }
                }
            }
        } catch (Exception $e) {
            die('Erreur lors de la lecture du fichier Excel : ' . $e->getMessage());
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>
          </p>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/footer.php'; ?>

