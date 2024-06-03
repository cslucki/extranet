<?php
ob_start(); // Assurez-vous que rien n'est envoyé avant cette ligne

// index.php
require_once 'config.php';
require_once 'controllers.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';


switch ($page) {
        case 'home': // pour la page d'accueil
            $controller = new HomeController();
        break;    
        /* flux pour la création d'un dossier */
        case 'showLogin': // pour afficher le formulaire de login
            $controller = new EntityController();
            $controller->showLogin();
            break;
        case 'verifyLogin': // pour vérifier le login
            $controller = new EntityController();
            $controller->verifyLogin();
            break;
        case 'newDossier': // pour afficher le formulaire de création d'un nouveau dossier
            $controller = new EntityController();
            $controller->newDossier();
            break;
        case 'storeDossier': // pour enregistrer un nouveau dossier
            $controller = new EntityController();
            $controller->storeDossier();
            break;
        case 'viewDossierAfterCreation': // pour afficher un dossier après sa création
            $controller->viewDossierAfterCreation();
            break;
        /* flux pour affiche des dossiers et gérer un CRUD des dossiers */
        case 'dossiers': // pour afficher la liste des dossiers
            $controller = new EntityController();
            $controller->dossiers();
            break;
        case 'viewDossier': // pour afficher un dossier
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $controller = new EntityController();
            $controller->viewDossier($id);
            break;
        case 'editDossier': // pour l'édition d'un dossier
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $controller = new EntityController();
            $controller->editDossier($id);
            break;
        case 'updateDossier': // pour la mise à jour d'un dossier
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $controller = new EntityController();
            $controller->updateDossier($id);
            break;
        case 'deleteDossier': // pour la suppression d'un dossier
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $controller = new EntityController();
            $controller->deleteDossier($id);
            break;
        case 'processDossierActions': // pour les actions de masse sur les dossiers
            $controller = new EntityController();
            $controller->processActions();
            break;

        // menuStatutFormation
        case 'menuStatutFormation':
            $controller = new MenuStatutFormationController();
            $controller->handleRequest(); 
            break;
        // menuFormation_Catalogue
        case 'menuFormation_Catalogue':
            $controller = new FormationCatalogueController();
            $controller->handleRequest(); 
            break;
        
        // viewLocalDrive
        case 'viewLocalDrive': // pour ouvrir un dossier local
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $controller = new EntityController();
            $controller->viewLocalDrive($id);
            break;
        // viewFileContent
        case 'viewPdfContent':
            $filePath = isset($_GET['file']) ? $_GET['file'] : '';
            $controller = new EntityController();
            $controller->viewPdfContent($filePath);
            break;

            /****  Gestion de la page par défaut ou erreur 404  ****/
    default:
    echo "Page non trouvée.";
    break;

}


// Appel de la méthode correspondant à l'action
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    // debug echo "Action '$action' not found in controller '$page'.";
}

ob_end_flush(); // Envoie le contenu du tampon et désactive la mise en tampon

?>