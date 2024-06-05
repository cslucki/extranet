<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Gestion des Abandons
    </div>
    <div class="card-body">
        <?php
        // Déterminer l'action
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $controller = new ManageAbandon();

        // Gestion des actions en fonction de la méthode de requête
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $controller->storeAbandon();
            } elseif ($action === 'update' && $id) {
                $controller->updateAbandon($id);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'delete' && $id) {
            // Logique pour la suppression via GET
            $controller->deleteAbandon($id);
        }

        switch ($action) {
            case 'add':
                ?>
                <h2>Ajouter un Abandon</h2>
                <form method="post" action="?page=manageAbondon&action=store">
                    <input type="text" name="id_formation_dossiers" placeholder="ID Formation Dossiers" required><br>
                    <input type="text" name="f20_abandon" placeholder="Abandon" required><br>
                    <input type="text" name="f20_abandon_raison" placeholder="Raison de l'Abandon" required><br>
                    <input type="date" name="f20_abandon_raison_date" placeholder="Date de la Raison" required><br>
                    <input type="text" name="f20_abandon_solution" placeholder="Solution" required><br>
                    <input type="date" name="f20_abandon_solution_date" placeholder="Date de la Solution" required><br>
                    <button type="submit">Ajouter</button>
                </form>
                <?php
                break;

            case 'edit':
                $abandon = $controller->editAbandon($id);
                ?>
                <h2>Modifier l'Abandon</h2>
                <form method="post" action="?page=manageAbondon&action=update&id=<?= $id ?>">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="text" name="id_formation_dossiers" value="<?= $abandon['id_formation_dossiers'] ?>" required><br>
                    <input type="text" name="f20_abandon" value="<?= $abandon['f20_abandon'] ?>" required><br>
                    <input type="text" name="f20_abandon_raison" value="<?= $abandon['f20_abandon_raison'] ?>" required><br>
                    <input type="date" name="f20_abandon_raison_date" value="<?= $abandon['f20_abandon_raison_date'] ?>" required><br>
                    <input type="text" name="f20_abandon_solution" value="<?= $abandon['f20_abandon_solution'] ?>" required><br>
                    <input type="date" name="f20_abandon_solution_date" value="<?= $abandon['f20_abandon_solution_date'] ?>" required><br>
                    <button type="submit">Modifier</button>
                </form>
                <?php
                break;

            case 'view':
            default:
                $abandonItems = $controller->index();
                ?>
                <h2>Liste des Abandons</h2>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID Formation Dossiers</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Numéro</th>
                            <th>Titre</th>
                            <th>Date de Début</th>
                            <th>Date de Fin</th>
                            <th>Raison de l'Abandon</th>
                            <th>Solution</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- Afficher les données des abandons -->
                    <?php foreach ($abandonItems as $item): ?>
                        <tr>
                            <td><?= $item['id_formation_dossiers'] ?></td>
                            <td><?= $item['prenom'] ?></td>
                            <td><?= $item['nom'] ?></td>
                            <td><?= $item['numero'] ?></td>
                            <td><?= $item['titre'] ?></td>
                            <td><?= $item['date_debut_formation'] ?></td>
                            <td><?= $item['date_fin_formation'] ?></td>
                            <td><?= $item['f20_abandon_raison'] ?></td>
                            <td><?= $item['f20_abandon_solution'] ?></td>
                            <td>
                                <a href="?page=manageAbondon&action=edit&id=<?= $item['id_formation_dossiers'] ?>">Modifier</a> -
                                <a href="?page=manageAbondon&action=delete&id=<?= $item['id_formation_dossiers'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <a href="?page=manageAbondon&action=add">Ajouter un nouvel abandon</a>
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