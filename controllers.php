<?php
require_once 'models.php';

// Base Controller pour les contrôleurs
class BaseController {
    }

// Contrôleur pour la page d'accueil
class HomeController extends BaseController {
    public function index() {
        $page_title = 'Home';
        include 'views.php';
        render('home', [], $page_title);
    }
    }

// Contrôleur pour les entités (dossiers, utilisateurs, etc.)
class EntityController extends BaseController {
// dossiers() pour afficher la liste des dossiers - méthode principale
    
    public function dossiers() {
        $page_title = 'Dossiers de Formation';
        $database = new Database();
        $statuses = $this->generateStatusMenu($database);  // Récupérer les statuts ici
        $formations = $this->generateFormationMenu($database);  // Récupérer les formations ici
    
        // Filtrer les dossiers par formation si une formation est sélectionnée
        $formationFilter = '';
        $selectedFormationId = null;
        $selectedFormation = null;
        if (isset($_POST['formation_id']) && !empty($_POST['formation_id'])) {
            $formationFilter = "WHERE fd.id_formation_catalogue = :formation_id";
            $selectedFormationId = $_POST['formation_id'];
            $selectedFormation = $this->getFormationById($database, $selectedFormationId);
        }
    
        $sql = "SELECT fd.id_formation_dossiers, fd.date_devis, fd.date_debut_formation, fd.date_fin_formation, fd.date_pec, fd.pec_numero,
        CONCAT(fc.numero, ' - ', fc.titre) AS formation, ms.text AS statut,
        uc.prenom, uc.nom, u.login
        FROM formation_dossiers fd
        LEFT JOIN formation_catalogue fc ON fd.id_formation_catalogue = fc.id_formation_catalogue
        LEFT JOIN menustatutformation ms ON fd.id_menustatutformation = ms.id
        LEFT JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid
        LEFT JOIN user u ON uc.id_guid = u.id_guid
        $formationFilter";  // Ajouter le filtre de formation
        
        $query = $database->query($sql);
        if (!empty($formationFilter)) {
            $query->execute(['formation_id' => $selectedFormationId]);
        } else {
            $query->execute();
        }
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
    
        include 'views.php';
        render('dossiers', [
            'data' => $data, 
            'statuses' => $statuses, 
            'formations' => $formations, 
            'selectedFormationId' => $selectedFormationId, 
            'selectedFormation' => $selectedFormation, 
            'page_title' => $page_title
        ]);
    }
    // Méthode pour récupérer les informations de la formation par ID
    private function getFormationById($database, $formationId) {
        $sql = "SELECT CONCAT(numero, ' - ', titre) AS formation FROM formation_catalogue WHERE id_formation_catalogue = :formation_id";
        $query = $database->query($sql);
        $query->execute(['formation_id' => $formationId]);
        return $query->fetchColumn();
    }






// viewDossier() pour afficher les détails d'un dossier
    public function viewDossier($id) {
        $page_title = 'Détails du Dossier de Formation';
        $database = new Database();
        $sql = "SELECT fd.*, fc.titre, ms.text AS statut, 
                       uc.prenom, uc.nom
                FROM formation_dossiers fd 
                JOIN formation_catalogue fc ON fd.id_formation_catalogue = fc.id_formation_catalogue 
                JOIN menustatutformation ms ON fd.id_menustatutformation = ms.id 
                JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid
                WHERE fd.id_formation_dossiers = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $dossier = $query->fetch(PDO::FETCH_ASSOC);

        if ($dossier) {
            include 'views.php';
            render('view_dossier', ['dossier' => $dossier], $page_title);
        } else {
            header('Location: index.php?page=dossiers'); // Redirect if no dossier found
            exit;
        }
    }
// editDossier() pour afficher le formulaire de modification
    public function editDossier($id) {
        $page_title = 'Éditer le Dossier de Formation';
        $database = new Database();
        $sql = "SELECT fd.*, fc.titre, fc.numero, ms.text AS statut, 
                       uc.prenom, uc.nom
                FROM formation_dossiers fd 
                JOIN formation_catalogue fc ON fd.id_formation_catalogue = fc.id_formation_catalogue 
                JOIN menustatutformation ms ON fd.id_menustatutformation = ms.id 
                JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid
                WHERE fd.id_formation_dossiers = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $dossier = $query->fetch(PDO::FETCH_ASSOC);

        $formations = $this->getFormations();

        if ($dossier) {
            include 'views.php';
            render('edit_dossier', ['dossier' => $dossier, 'formations' => $formations], $page_title);
        } else {
            header('Location: index.php?page=dossiers'); // Redirect if no dossier found
            exit;
        }
    }

// updateDossier() pour traiter la mise à jour du dossier
    public function updateDossier($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupération des données du formulaire
            $data = [
                'id' => $id,
                'id_formation_catalogue' => $_POST['id_formation_catalogue'],
                'date_debut_formation' => $_POST['date_debut_formation'],
                'date_fin_formation' => $_POST['date_fin_formation'],
            ];

            // Mise à jour de la base de données
            $database = new Database();
            $sql = "UPDATE formation_dossiers SET
                    id_formation_catalogue = :id_formation_catalogue,
                    date_debut_formation = :date_debut_formation,
                    date_fin_formation = :date_fin_formation
                    WHERE id_formation_dossiers = :id";
            $query = $database->query($sql);
            $query->execute($data);

            // Redirection vers la liste des dossiers
            header('Location: index.php?page=dossiers');
            exit;
        }
    }

// deleteDossier() pour supprimer un dossier
    public function deleteDossier($id) {
        $database = new Database();
        $sql = "DELETE FROM formation_dossiers WHERE id_formation_dossiers = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);

            // Redirection vers la liste des dossiers après suppression
        header('Location: index.php?page=dossiers');
        exit;
    }

// showLogin() pour afficher le formulaire de login
    public function showLogin() {
        include 'views.php';
        render('login_dossier', [], 'Login pour Dossier');
    }

// verifyLogin() pour vérifier le login et rediriger vers la création de dossier
    public function verifyLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['login'])) {
            $database = new Database();
            $sql = "SELECT * FROM user WHERE login = :login";
            $query = $database->query($sql);
            $query->execute(['login' => $_POST['login']]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Redirection vers la page de création de dossier avec l'ID de l'utilisateur
                header("Location: index.php?page=newDossier&user_id={$user['id_guid']}");
                exit;
            } else {
                echo "Login incorrect. Veuillez réessayer.";
            }
        } else {
            header("Location: index.php?page=showLogin");
            exit;
        }
    }

// newDossier() pour afficher le formulaire de création de dossier
    public function newDossier() {
        $user_id = $_GET['user_id'] ?? null;  // S'assurer que user_id est récupéré de la bonne source
    
        if (!$user_id) {
            echo "Identifiant utilisateur non spécifié ou incorrect.";
            exit;
        }
    
        $database = new Database();
        $formations = $this->getFormations();
        include 'views.php';
        render('new_dossier', ['formations' => $formations, 'user_id' => $user_id], 'Nouveau Dossier');
    }

// createDossier() pour afficher le formulaire de création de dossier
    public function createDossier($login) {
        $database = new Database();
        $userSql = "SELECT * FROM user WHERE login = :login";
        $userQuery = $database->query($userSql);
        $userQuery->execute(['login' => $login]);
        $user = $userQuery->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "Utilisateur non trouvé.";
            exit;
        }

        // Si l'utilisateur existe, afficher le formulaire
        $formations = $this->getFormations();
        include 'views.php';
        render('create_dossier', ['formations' => $formations, 'user_id' => $user['id_guid']], 'Créer un Dossier');
    }

// getFormations() est une méthode privée pour éviter les appels directs
    private function getFormations() {
        $database = new Database();
        $sql = "SELECT id_formation_catalogue, numero, titre FROM formation_catalogue WHERE is_catalogue = 'Y'";
        $query = $database->query($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

// storeDossier() pour traiter la création du dossier et rediriger
    public function storeDossier() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $database = new Database();
        $sql = "INSERT INTO formation_dossiers (id_formation_catalogue, date_devis, id_guid) VALUES (:id_formation_catalogue, :date_devis, :id_guid)";
        $query = $database->query($sql);
        $query->execute([
            'id_formation_catalogue' => $_POST['id_formation_catalogue'],
            'date_devis' => $_POST['date_devis'],
            'id_guid' => $_POST['id_guid']
        ]);
        $lastId = $database->lastInsertId();
        header("Location: index.php?page=viewDossierAfterCreation&id=$lastId");
        exit;
        }
    }
// viewDossierAfterCreation() pour afficher le dossier après la création
    public function viewDossierAfterCreation() {
    $dossier_id = $_GET['id'] ?? null;

    if (!$dossier_id) {
        echo "Identifiant du dossier non spécifié ou incorrect.";
        exit;
    }

    $database = new Database();
    $sql = "SELECT id_formation_catalogue, date_devis, id_guid FROM formation_dossiers WHERE id_formation_dossiers = :id";
    $query = $database->query($sql);
    $query->execute(['id' => $dossier_id]);
    $dossier = $query->fetch(PDO::FETCH_ASSOC);

    if ($dossier) {
        $formations = $this->getFormations();
        include 'views.php';
        render('create_dossier', ['formations' => $formations, 'dossier' => $dossier], 'Créer un Dossier');
    } else {
        echo "Dossier non trouvé.";
        exit;
        }
    }

// generateStatusMenu() pour afficher le menu déroulant des statuts
    public function generateStatusMenu($database, $selectedId = null) {
        try {
            $sql = "SELECT id, text FROM menustatutformation";
            $query = $database->query($sql);
            $query->execute();
            $statuses = $query->fetchAll(PDO::FETCH_ASSOC);
            $html = '<select class="form-control" name="status_id">';
            foreach ($statuses as $status) {
                $selected = ($status['id'] == $selectedId) ? ' selected' : '';
                $html .= "<option value='{$status['id']}'{$selected}>{$status['text']}</option>";
            }
            $html .= '</select>';
            return $html;
        } catch (PDOException $e) {
            return "Erreur lors du chargement des statuts : " . $e->getMessage(); // S'assurer que cela retourne une chaîne
        }
    }

// generateFormationMenu() pour afficher le menu déroulant des formations
    public function generateFormationMenu($database, $selectedId = null) {
        $page_title = 'Entretiens préalables';
    try {
        $sql = "SELECT id_formation_catalogue, CONCAT(numero, ' - ', titre) AS formation FROM formation_catalogue";
        $query = $database->query($sql);
        $query->execute();
        $formations = $query->fetchAll(PDO::FETCH_ASSOC);

        // Débogage des formations récupérées
        error_log('Formations from DB: ' . print_r($formations, true));

        $html = '<select class="form-control custom-select-width" name="formation_id">';
        foreach ($formations as $formation) {
            $selected = ($formation['id_formation_catalogue'] == $selectedId) ? ' selected' : '';
            $html .= "<option value='{$formation['id_formation_catalogue']}'{$selected}>{$formation['formation']}</option>";
        }
        $html .= '</select>';
        return $html;
    } catch (PDOException $e) {
        return "Erreur lors du chargement des formations : " . $e->getMessage();
    }
    }


// viewLocalDrive() pour ouvrir le dossier local  
    public function viewLocalDrive() {
    $page_title = 'Contenu du dossier';
    $fileId = isset($_GET['id']) ? $_GET['id'] : '';
    
    //echo "<h2>Débogage de viewLocalDrive</h2>";
    //echo "<li>ID du fichier : $fileId</li>";

    if ($fileId) {
        $baseDirectoryPath = "d:/extranet/drive/";
        $baseUrlPath = "http://extranet/drive/";

        //echo "<li>Chemin de base du répertoire : $baseDirectoryPath</li>";
        //echo "<li>Chemin de base de l'URL : $baseUrlPath</li>";

        if (!is_dir($baseDirectoryPath)) {
            echo "Le chemin de base n'existe pas ou n'est pas un répertoire.";
            return;
        } else {
            echo "<li>Le chemin de base existe et est un répertoire.</li>";
        }

        $matchingDirectories = [];
        $directories = scandir($baseDirectoryPath);
        //echo "<li>Répertoires trouvés : " . implode(', ', $directories) . "</li>";

        foreach ($directories as $directory) {
            if (is_dir($baseDirectoryPath . $directory) && preg_match("/^0*$fileId-/", $directory)) {
                $matchingDirectories[] = $directory;
            }
        }

        //echo "<li>Répertoires correspondants : " . implode(', ', $matchingDirectories) . "</li>";

        if (!empty($matchingDirectories)) {
            $directoryPath = $baseDirectoryPath . $matchingDirectories[0];
            $urlPath = $baseUrlPath . $matchingDirectories[0];

            //echo "<li>Chemin du répertoire : $directoryPath</li>";
            //echo "<li>Chemin de l'URL : $urlPath</li>";

            $pdfFiles = glob("$directoryPath/*.pdf");
            //echo "<li>Fichiers PDF trouvés : " . implode(', ', $pdfFiles) . "</li>";

            $pdfFilesUrls = array_map(function($file) use ($urlPath) {
                return $urlPath . '/' . basename($file);
            }, $pdfFiles);

            //echo "<li>URLs des fichiers PDF : " . implode(', ', $pdfFilesUrls) . "</li>";

            $debugInfo = [
                'ID du fichier' => $fileId,
                'Chemin du dossier' => $directoryPath,
                'Fichiers PDF trouvés' => $pdfFiles,
                'URLs PDF' => $pdfFilesUrls
            ];
            include 'views.php';
            render('view_local_drive', ['pdfFiles' => $pdfFilesUrls, 'debugInfo' => $debugInfo], $page_title);
        } else {
            echo "Aucun dossier correspondant pour l'ID $fileId.";
        }
    } else {
        echo "Aucun ID de fichier spécifié.";
    }
    }
// viewPdfContent() pour afficher le contenu du PDF
    public function viewPdfContent() {
    $page_title = 'Contenu du dossier';
    $fileUrl = isset($_GET['file']) ? urldecode($_GET['file']) : '';

    // Afficher l'URL du fichier pour le débogage
    //echo "URL du fichier : " . htmlspecialchars($fileUrl) . "<br>";

    // Convertir l'URL en chemin de fichier local
    $filePath = str_replace("http://extranet/drive/", "d:/extranet/drive/", $fileUrl);

    // Afficher le chemin du fichier pour le débogage
    //echo "Chemin du fichier : " . htmlspecialchars($filePath) . "<br>";

    // Vérifier si le fichier existe
    if ($filePath && file_exists($filePath)) {
        include 'views.php';
        render('view_pdf_content', ['filePath' => $fileUrl], $page_title); // Utiliser l'URL pour l'affichage dans le navigateur
    } else {
        echo "Le fichier spécifié n'existe pas.<br>";
        echo "Chemin absolu vérifié : " . realpath($filePath) . "<br>";
    }
    }



// Traiter les actions de groupe dans views/dossiers.php
    public function processActions() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            if ($_POST['action'] == 'delete') {
                $ids = implode(',', $_POST['selected_dossiers']);
                $sql = "DELETE FROM formation_dossiers WHERE id_formation_dossiers IN ($ids)";
                $database->query($sql)->execute();
            } elseif ($_POST['action'] == 'updateStatus') {
                $ids = implode(',', $_POST['selected_dossiers']);
                $sql = "UPDATE formation_dossiers SET id_menustatutformation = :status WHERE id_formation_dossiers IN ($ids)";
                $database->query($sql)->execute(['status' => $_POST['status_id']]);
            }
            header("Location: index.php?page=dossiers");
            exit;
        }
    }
    }

/** CRUD pour la table menustatutformation **/
    class MenuStatutFormationController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $this->storeMenuStatutFormation();
            } elseif ($action === 'update' && $id) {
                $this->updateMenuStatutFormation($id);
            }
        }

        $this->renderView($action, $id);
    }

    public function index() {
        $database = new Database();
        $sql = "SELECT * FROM menustatutformation ORDER BY id ASC";
        $query = $database->query($sql);

        if ($query === false) {
            echo "Erreur lors de la préparation de la requête : " . $database->errorInfo()[2] . "<br>";
            return [];
        }

        $query->execute();
        if ($query->errorCode() != '00000') {
            echo "Erreur lors de l'exécution de la requête : " . $query->errorInfo()[2] . "<br>";
            return [];
        }

        $menuItems = $query->fetchAll(PDO::FETCH_ASSOC);
        return $menuItems;
    }

    public function viewMenuStatutFormation($id) {
        $page_title = 'Détails du Menu Statut de Formation';
        $database = new Database();
        $sql = "SELECT * FROM menustatutformation WHERE id = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $menu_formation = $query->fetch(PDO::FETCH_ASSOC);

        if ($menu_formation) {
            include 'views.php';
            render('viewMenuStatutFormation', ['menu_formation' => $menu_formation], $page_title);
        } else {
            header('Location: index.php?page=menuStatutFormation');
            exit;
        }
    }

    public function editMenuStatutFormation($id) {
        $page_title = 'Éditer Menu statut formation';
        $database = new Database();
        $sql = "SELECT * FROM menustatutformation WHERE id = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $menu_formation = $query->fetch(PDO::FETCH_ASSOC);

        if ($menu_formation) {
            return $menu_formation;
        } else {
            header('Location: index.php?page=menuStatutFormation');
            exit;
        }
    }

    public function updateMenuStatutFormation($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'text' => $_POST['text']
            ];

            $database = new Database();
            $sql = "UPDATE menustatutformation SET text = :text WHERE id = :id";
            $query = $database->query($sql);
            $query->execute($data);

            header('Location: index.php?page=menuStatutFormation');
            exit;
        }
    }

    public function deleteMenuStatutFormation($id) {
        $database = new Database();
        $sql = "DELETE FROM menustatutformation WHERE id = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        header('Location: index.php?page=menuStatutFormation');
        exit;
    }
    
    public function addMenuStatutFormation() {
        $page_title = 'Ajouter Menu statut formation';
        include 'views.php';
        render('addMenuStatutFormation', [], $page_title);
    }

    public function storeMenuStatutFormation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'text' => $_POST['text']
            ];

            $database = new Database();
            $sql = "INSERT INTO menustatutformation (text) VALUES (:text)";
            $query = $database->query($sql);
            $query->execute($data);

            header('Location: index.php?page=menuStatutFormation');
            exit;
        }
    }


    private function renderView($action, $id) {
        include 'views.php';
        render('manageMenuStatutFormation', ['action' => $action, 'id' => $id]);
    }
    }

/** CRUD pour la table formation_catalogue **/
 class FormationCatalogueController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $this->storeFormationCatalogue();
            } elseif ($action === 'update' && $id) {
                $this->updateFormationCatalogue($id);
            }
        }

        $this->renderView($action, $id);
    }

    public function index() {
        $database = new Database();
        $sql = "SELECT * FROM formation_catalogue ORDER BY id_formation_catalogue ASC";
        $query = $database->query($sql);

        if ($query === false) {
            echo "Erreur lors de la préparation de la requête : " . $database->errorInfo()[2] . "<br>";
            return [];
        }

        $query->execute();
        if ($query->errorCode() != '00000') {
            echo "Erreur lors de l'exécution de la requête : " . $query->errorInfo()[2] . "<br>";
            return [];
        }

        $formationItems = $query->fetchAll(PDO::FETCH_ASSOC);
        return $formationItems;
    }

    public function viewFormationCatalogue($id) {
        $page_title = 'Détails de la Formation Catalogue';
        $database = new Database();
        $sql = "SELECT * FROM formation_catalogue WHERE id_formation_catalogue = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $formation = $query->fetch(PDO::FETCH_ASSOC);

        if ($formation) {
            include 'views.php';
            render('viewFormationCatalogue', ['formation' => $formation], $page_title);
        } else {
            header('Location: index.php?page=menuFormation_Catalogue');
            exit;
        }
    }

    public function editFormationCatalogue($id) {
        $page_title = 'Éditer Formation Catalogue';
        $database = new Database();
        $sql = "SELECT * FROM formation_catalogue WHERE id_formation_catalogue = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $formation = $query->fetch(PDO::FETCH_ASSOC);

        if ($formation) {
            return $formation;
        } else {
            header('Location: index.php?page=menuFormation_Catalogue');
            exit;
        }
    }

    public function updateFormationCatalogue($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'titre' => $_POST['titre'],
                'numero' => $_POST['numero'],
                'duree_synchrone' => $_POST['duree_synchrone'],
                'duree_asynchrone' => $_POST['duree_asynchrone'],
                'prix' => $_POST['prix'],
                'description' => $_POST['description'],
                'is_catalogue' => $_POST['is_catalogue']
            ];

            $database = new Database();
            $sql = "UPDATE formation_catalogue SET titre = :titre, numero = :numero, duree_synchrone = :duree_synchrone, duree_asynchrone = :duree_asynchrone, prix = :prix, description = :description, is_catalogue = :is_catalogue WHERE id_formation_catalogue = :id";
            $query = $database->query($sql);
            $query->execute($data);

            header('Location: index.php?page=menuFormation_Catalogue');
            exit;
        }
    }

    public function deleteFormationCatalogue($id) {
        $database = new Database();
        $sql = "DELETE FROM formation_catalogue WHERE id_formation_catalogue = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        header('Location: index.php?page=menuFormation_Catalogue');
        exit;
    }
    
    public function addFormationCatalogue() {
        $page_title = 'Ajouter Formation Catalogue';
        include 'views.php';
        render('addFormationCatalogue', [], $page_title);
    }

    public function storeFormationCatalogue() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'titre' => $_POST['titre'],
                'numero' => $_POST['numero'],
                'duree_synchrone' => $_POST['duree_synchrone'],
                'duree_asynchrone' => $_POST['duree_asynchrone'],
                'prix' => $_POST['prix'],
                'description' => $_POST['description'],
                'is_catalogue' => $_POST['is_catalogue']
            ];

            $database = new Database();
            $sql = "INSERT INTO formation_catalogue (titre, numero, duree_synchrone, duree_asynchrone, prix, description, is_catalogue) VALUES (:titre, :numero, :duree_synchrone, :duree_asynchrone, :prix, :description, :is_catalogue)";
            $query = $database->query($sql);
            $query->execute($data);

            header('Location: index.php?page=menuFormation_Catalogue');
            exit;
        }
    }

    private function renderView($action, $id) {
        include 'views.php';
        render('manageFormationCatalogue', ['action' => $action, 'id' => $id]);
        }
    }
/** CRUD pour la table formation_questionnaire_avant **/
    class FormationQuestionnaireController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $this->storeFormationQuestionnaire();
            } elseif ($action === 'update' && $id) {
                $this->updateFormationQuestionnaire($id);
            }
        }

        $this->renderView($action, $id);
    }

    public function index() {
        $database = new Database();
        $sql = "SELECT fqa.*, uc.prenom, uc.nom, fd.id_guid 
                FROM formation_questionnaire_avant fqa
                JOIN formation_dossiers fd ON fqa.id_formation_dossiers = fd.id_formation_dossiers
                JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid
                ORDER BY fqa.id_formation_dossiers ASC";
        $query = $database->query($sql);

        if ($query === false) {
            echo "Erreur lors de la préparation de la requête : " . $database->errorInfo()[2] . "<br>";
            return [];
        }

        $query->execute();
        if ($query->errorCode() != '00000') {
            echo "Erreur lors de l'exécution de la requête : " . $query->errorInfo()[2] . "<br>";
            return [];
        }

        $questionnaires = $query->fetchAll(PDO::FETCH_ASSOC);
        return $questionnaires;
    }

    public function viewDetailFormationQuestionnaire($id) {
        $database = new Database();
        $sql = "SELECT fqa.*, uc.prenom, uc.nom, fc.numero, fc.titre 
                FROM formation_questionnaire_avant fqa
                JOIN formation_dossiers fd ON fqa.id_formation_dossiers = fd.id_formation_dossiers
                JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid
                JOIN formation_catalogue fc ON fd.id_formation_catalogue = fc.id_formation_catalogue
                WHERE fqa.id_formation_dossiers = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $questionnaire = $query->fetch(PDO::FETCH_ASSOC);

        if ($questionnaire) {
            return $questionnaire;
        } else {
            header('Location: index.php?page=formationQuestionnaire');
            exit;
        }
    }

    public function editFormationQuestionnaire($id) {
        $database = new Database();
        $sql = "SELECT fqa.*, uc.prenom, uc.nom, fc.numero, fc.titre 
        FROM formation_questionnaire_avant fqa
        JOIN formation_dossiers fd ON fqa.id_formation_dossiers = fd.id_formation_dossiers
        JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid
        JOIN formation_catalogue fc ON fd.id_formation_catalogue = fc.id_formation_catalogue
        WHERE fqa.id_formation_dossiers = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);
        $questionnaire = $query->fetch(PDO::FETCH_ASSOC);

        if ($questionnaire) {
            return $questionnaire;
        } else {
            header('Location: index.php?page=formationQuestionnaire');
            exit;
        }
    }

    public function updateFormationQuestionnaire($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'id_formation_dossiers' => $_POST['id_formation_dossiers'],
                'participation_prealable' => $_POST['participation_prealable'],
                'date_debut_souhaitee' => $_POST['date_debut_souhaitee'],
                'attentes_formation' => $_POST['attentes_formation'],
                'competence1' => $_POST['competence1'],
                'competence2' => $_POST['competence2'],
                'competence3' => $_POST['competence3'],
                'competence4' => $_POST['competence4'],
                'competence5' => $_POST['competence5'],
                'competence6' => $_POST['competence6']
            ];

            $database = new Database();
            $sql = "UPDATE formation_questionnaire_avant SET
                    id_formation_dossiers = :id_formation_dossiers,
                    participation_prealable = :participation_prealable,
                    date_debut_souhaitee = :date_debut_souhaitee,
                    attentes_formation = :attentes_formation,
                    competence1 = :competence1,
                    competence2 = :competence2,
                    competence3 = :competence3,
                    competence4 = :competence4,
                    competence5 = :competence5,
                    competence6 = :competence6
                    WHERE id_formation_dossiers = :id";
            $query = $database->query($sql);
            $query->execute($data);

            header('Location: index.php?page=formationQuestionnaire');
            exit;
        }
    }

    public function deleteFormationQuestionnaire($id) {
        $database = new Database();
        $sql = "DELETE FROM formation_questionnaire_avant WHERE id_formation_dossiers = :id";
        $query = $database->query($sql);
        $query->execute(['id' => $id]);

        header('Location: index.php?page=formationQuestionnaire');
        exit;
    }

    public function storeFormationQuestionnaire() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_formation_dossiers' => $_POST['id_formation_dossiers'],
                'participation_prealable' => $_POST['participation_prealable'],
                'date_debut_souhaitee' => $_POST['date_debut_souhaitee'],
                'attentes_formation' => $_POST['attentes_formation'],
                'competence1' => $_POST['competence1'],
                'competence2' => $_POST['competence2'],
                'competence3' => $_POST['competence3'],
                'competence4' => $_POST['competence4'],
                'competence5' => $_POST['competence5'],
                'competence6' => $_POST['competence6']
            ];

            $database = new Database();
            $sql = "INSERT INTO formation_questionnaire_avant (id_formation_dossiers, participation_prealable, date_debut_souhaitee, attentes_formation, competence1, competence2, competence3, competence4, competence5, competence6) 
                    VALUES (:id_formation_dossiers, :participation_prealable, :date_debut_souhaitee, :attentes_formation, :competence1, :competence2, :competence3, :competence4, :competence5, :competence6)";
            $query = $database->query($sql);
            $query->execute($data);

            header('Location: index.php?page=formationQuestionnaire');
            exit;
        }
    }

    private function renderView($action, $id) {
        include 'views.php';
        render('formationquestionnaire', ['action' => $action, 'id' => $id]);
    }
    }


/** Vue lm_gestion_lm_comments */
    class CommentController extends BaseController {
    
    public function handleRequest() {
        $id_guid = isset($_GET['id_guid']) ? $_GET['id_guid'] : null;
        
        // Débogage : Afficher la valeur de id_guid
        //echo "Debug: id_guid = " . $id_guid;

        if ($id_guid) {
            $this->viewComments($id_guid);
        } else {
            echo "GUID non spécifié.";
        }
    }
    public function listComments() {
        $database = new Database();
        $sql = "SELECT fd.id_formation_dossiers, uc.prenom, uc.nom, fd.id_guid
                FROM formation_dossiers fd
                JOIN user_coordonnee uc ON fd.id_guid = uc.id_guid LIMIT 2";
        $query = $database->query($sql);
        
        // Debug: Afficher la requête SQL
        //echo "Executing listComments SQL query<br>";
        
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        // Debug: Afficher le nombre de résultats
        //echo "Number of results from listComments query: " . count($results) . "<br>";
        
        $comments = [];
        
        foreach ($results as $result) {
            // Debug: Afficher le résultat actuel en cours de traitement
            //echo "Processing result with GUID: " . $result['id_guid'] . "<br>";
            
            $comment_count = $this->countCommentsByGuid($result['id_guid']);
            
            // Debug: Afficher le nombre de commentaires récupéré
            //echo "Comment count retrieved: " . $comment_count . "<br>";
            
            $result['comment_count'] = $comment_count;
            $comments[] = $result;
            
            // Debug: Afficher le résultat après avoir ajouté le nombre de commentaires
            //echo "Result after adding comment count: " . print_r($result, true) . "<br>";
        }
        
        include 'views.php';
        render('comments', ['comments' => $comments], 'Liste des Commentaires');
    }


    public function viewComments($id_guid) {
        $page_title = 'Détails des Commentaires';
        $database = new Database();
        //echo "Debug: id_guid = " . $id_guid;

        // Requête pour récupérer les commentaires de la table lm_gestion_lm_comments
        $sql = "SELECT comments, date FROM lm_gestion_lm_comments WHERE id_guid_to = :id_guid ORDER by date DESC";
        $query = $database->query($sql);
        $query->execute(['id_guid' => $id_guid]);
        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        include 'views.php';
        render('viewComments', ['comments' => $comments], $page_title);
    }

    private function countCommentsByGuid($guid) {
        $database = new Database();
        $sql = "SELECT COUNT(id_guid_to) AS comment_count FROM lm_gestion_lm_comments WHERE id_guid_to = :guid";
        
        // Debug: Afficher le GUID utilisé
        //echo "Executing countCommentsByGuid with GUID: " . $guid . "<br>";
        
        $query = $database->query($sql);
        
        // Debug: Vérifier si la requête a été préparée correctement
        if ($query === false) {
            echo "Failed to prepare query<br>";
            return 0;
        }
        
        // Debug: Avant l'exécution de la requête
        //echo "Before executing query<br>";
        
        $query->execute(['guid' => $guid]);
        
        // Debug: Après l'exécution de la requête
        //echo "After executing query<br>";
        
        // Debug: Afficher le résultat de la requête
        $comment_count = $query->fetchColumn();
        //echo "Comment count for GUID " . $guid . ": " . $comment_count . "<br>";
        
        return $comment_count;
    }
    }




?>