<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Formation Catalogue
    </div>
    <div class="card-body">
        <?php
        // Déterminer l'action
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $controller = new FormationCatalogueController();

        // Gestion des actions en fonction de la méthode de requête
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $controller->storeFormationCatalogue();
            } elseif ($action === 'update' && $id) {
                $controller->updateFormationCatalogue($id);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'delete' && $id) {
            // Logique pour la suppression via GET
            $controller->deleteFormationCatalogue($id);
        }

        switch ($action) {
            case 'add':
                ?>
                <h2>Ajouter une Formation Catalogue</h2>
                <form method="post" action="?page=menuFormation_Catalogue&action=store">
                    <input type="text" name="titre" placeholder="Titre" required><br>
                    <input type="text" name="numero" placeholder="Numéro" required><br>
                    <input type="text" name="duree_synchrone" placeholder="Durée synchrone" required><br>
                    <input type="text" name="duree_asynchrone" placeholder="Durée asynchrone" required><br>
                    <input type="text" name="prix" placeholder="Prix" required><br>
                    <textarea name="description" placeholder="Description"></textarea><br>
                    <select name="is_catalogue">
                        <option value="Y">Oui</option>
                        <option value="N">Non</option>
                    </select><br>
                    <button type="submit">Ajouter</button>
                </form>
                <?php
                break;

            case 'edit':
                $formation = $controller->editFormationCatalogue($id);
                ?>
                <h2>Modifier la Formation Catalogue</h2>
                <form method="post" action="?page=menuFormation_Catalogue&action=update&id=<?= $id ?>">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="text" name="titre" value="<?= $formation['titre'] ?>" required><br>
                    <input type="text" name="numero" value="<?= $formation['numero'] ?>" required><br>
                    <input type="text" name="duree_synchrone" value="<?= $formation['duree_synchrone'] ?>" required><br>
                    <input type="text" name="duree_asynchrone" value="<?= $formation['duree_asynchrone'] ?>" required><br>
                    <input type="text" name="prix" value="<?= $formation['prix'] ?>" required><br>
                    <textarea name="description"><?= $formation['description'] ?></textarea><br>
                    <select name="is_catalogue">
                        <option value="Y" <?php if ($formation['is_catalogue'] == 'Y') echo 'selected'; ?>>Oui</option>
                        <option value="N" <?php if ($formation['is_catalogue'] == 'N') echo 'selected'; ?>>Non</option>
                    </select><br>
                    <button type="submit">Modifier</button>
                </form>
                <?php
                break;

            case 'view':
            default:
                $formationItems = $controller->index();
                ?>
                <h2>Liste des Formations Catalogue</h2>
                <table id="datatablesSimple">
                    <tr>
                        <th>Titre</th>
                        <th>Numéro</th>
                        <th>Durée synchrone</th>
                        <th>Durée asynchrone</th>
                        <th>Prix</th>
                        <th>Description</th>
                        <th>Est catalogue</th>
                        <th>Actions</th>
                    </tr>
                    <!-- Afficher les données des formations -->
                    <?php foreach ($formationItems as $item): ?>
                        <tr>
                            <td><?= $item['titre'] ?></td>
                            <td><?= $item['numero'] ?></td>
                            <td><?= $item['duree_synchrone'] ?></td>
                            <td><?= $item['duree_asynchrone'] ?></td>
                            <td><?= $item['prix'] ?></td>
                            <td><?= $item['description'] ?></td>
                            <td><?= $item['is_catalogue'] ?></td>
                            <td>
                                <a href="?page=menuFormation_Catalogue&action=edit&id=<?= $item['id_formation_catalogue'] ?>">Modifier</a> -
                                <a href="?page=menuFormation_Catalogue&action=delete&id=<?= $item['id_formation_catalogue'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <a href="?page=menuFormation_Catalogue&action=add">Ajouter une nouvelle formation</a>
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
