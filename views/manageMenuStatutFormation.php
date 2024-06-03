
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Statut de formation
    </div>
<div class="card-body">
<?php


// Déterminer l'action
$action = isset($_GET['action']) ? $_GET['action'] : 'view';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$controller = new MenuStatutFormationController();

// Gestion des actions en fonction de la méthode de requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'store') {
        $controller->storeMenuStatutFormation();
    } elseif ($action === 'update' && $id) {
        $controller->updateMenuStatutFormation($id);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'delete' && $id) {
    // Logique pour la suppression via GET
    $controller->deleteMenuStatutFormation($id);
}


switch ($action) {
    case 'add':
        ?>
        <h2>Ajouter un Menu Statut Formation</h2>
        <form method="post" action="?page=menuStatutFormation&action=store">
            <input type="text" name="text" placeholder="Statut" required>
            <button type="submit">Ajouter</button>
        </form>
        <?php
        break;

    case 'edit':
        $menu_formation = $controller->editMenuStatutFormation($id);
        ?>
        <h2>Modifier le Menu Statut Formation</h2>
        <form method="post" action="?page=menuStatutFormation&action=update&id=<?= $id ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="text" name="text" value="<?= $menu_formation['text'] ?>" required>
            <button type="submit">Modifier</button>
        </form>
        <?php
        break;

    case 'view':
    default:
        $menuItems = $controller->index();
        ?>
        <h2>Liste des Menus Statut Formation</h2>
        <table id="datatablesSimple">
            <!-- Afficher les données des statuts -->
            <?php foreach ($menuItems as $item): ?>
                <tr>
                    <td><?= $item['text'] ?></td>
                    <td>
                        <a href="?page=menuStatutFormation&action=edit&id=<?= $item['id'] ?>">Modifier</a> - 
                        <a href="?page=menuStatutFormation&action=delete&id=<?= $item['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="?page=menuStatutFormation&action=add">Ajouter un nouveau statut</a>
        <?php
        break;
}


?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dataTable = new simpleDatatables.DataTable('#datatablesSimple', {
            "perPage": 30 // Nombre d'entrées par défaut
        });
    });
</script>
