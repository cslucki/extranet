<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/header.php'; ?>
<div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">

<?php
require_once '../models.php';

class DossiersUtil {
    // Supprimer tous les dossiers de formation
    public static function deleteAllDossiers() {
        $database = new Database();
        $sql = "DELETE FROM formation_dossiers";
        $query = $database->query($sql);
        $query->execute();
        echo "Tous les dossiers de formation ont été supprimés.";
    }

    // Modifier le statut de tous les dossiers de formation
    public static function updateAllDossiersStatus($statusId) {
        $database = new Database();
        $sql = "UPDATE formation_dossiers SET id_menustatutformation = :status_id";
        $query = $database->query($sql);
        $query->execute(['status_id' => $statusId]);
        echo "Le statut de tous les dossiers de formation a été mis à jour.";
    }

    // Générer un menu "select" pour modifier le statut de tous les dossiers de formation
    public static function generateStatusMenu() {
        $database = new Database();
        $sql = "SELECT id, text FROM menustatutformation";
        $query = $database->query($sql);
        $query->execute();
        $statuses = $query->fetchAll(PDO::FETCH_ASSOC);

        $html = '<form method="post" action="DossiersUtil.php">';
        $html .= '<select name="status_id">';
        foreach ($statuses as $status) {
            $html .= "<option value='{$status['id']}'>{$status['text']}</option>";
        }
        $html .= '</select>';
        $html .= '<input type="submit" name="update_status" value="Mettre à jour le statut">';
        $html .= '</form>';

        return $html;
    }
}

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_all'])) {
        DossiersUtil::deleteAllDossiers();
    } elseif (isset($_POST['update_status'])) {
        $statusId = $_POST['status_id'];
        DossiersUtil::updateAllDossiersStatus($statusId);
    }
}
?>


    <h1>Utilitaires Dossiers</h1>
    <form method="post" action="DossiersUtil.php">
        <input type="submit" name="delete_all" value="Supprimer tous les dossiers">
    </form>
    <h2>Modifier le statut de tous les dossiers</h2>
    <?php echo DossiersUtil::generateStatusMenu(); ?>

          </p>
            </div>
        </div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/views/partials/footer.php'; ?>

