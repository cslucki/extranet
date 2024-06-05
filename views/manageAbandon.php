<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Bénéficiaires - Suivi des dossiers
    </div>
    <div class="card-body">
        <?php
        $action = isset($action) ? $action : 'view';
        $id = isset($id) ? $id : null;

        $controller = new ManageAbandon();

        switch ($action) {
            case 'add':
                ?>
                <h2>Ajouter</h2>
                <form method="post" action="?page=manageAbondon&action=store">
                    <div class="mb-3">
                        <label for="id_formation_dossiers" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id_formation_dossiers" name="id_formation_dossiers" placeholder="ID" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Abandon</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="f20_abandon" id="abandon_yes" value="Y" required>
                            <label class="form-check-label" for="abandon_yes">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="f20_abandon" id="abandon_no" value="N" required>
                            <label class="form-check-label" for="abandon_no">Non</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="f20_abandon_raison" class="form-label">Problème évoqué</label>
                        <textarea class="form-control" id="f20_abandon_raison" name="f20_abandon_raison" placeholder="Problème évoqué" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="f20_abandon_raison_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="f20_abandon_raison_date" name="f20_abandon_raison_date" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="f20_abandon_solution" class="form-label">Solution apportée</label>
                        <textarea class="form-control" id="f20_abandon_solution" name="f20_abandon_solution" placeholder="Solution apportée" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="f20_abandon_solution_date" class="form-label">Date de la solution</label>
                        <input type="date" class="form-control" id="f20_abandon_solution_date" name="f20_abandon_solution_date" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <?php
                break;

                case 'edit':
                    $abandon = $controller->editAbandon($id);
                    ?>
                    <form method="post" action="?page=manageAbondon&action=update&id=<?= $id ?>">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        
                        <div class="mb-3">
                            <label for="date_debut_formation" class="form-label">Dates de la formation</label>
                            <p>Du <?= $abandon['date_debut_formation'] ?> au <?= $abandon['date_fin_formation'] ?></p>
                        </div>
                        

                        
                        <div class="mb-3">
                            <label for="id_formation_dossiers" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id_formation_dossiers" name="id_formation_dossiers" value="<?= $abandon['id_formation_dossiers'] ?>" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Abandon</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="f20_abandon" id="abandon_yes" value="Y" <?= $abandon['f20_abandon'] == 'Y' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="abandon_yes">Oui</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="f20_abandon" id="abandon_no" value="N" <?= $abandon['f20_abandon'] == 'N' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="abandon_no">Non</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="f20_abandon_raison" class="form-label">Problème évoqué</label>
                            <textarea class="form-control" id="f20_abandon_raison" name="f20_abandon_raison" rows="3" required><?= $abandon['f20_abandon_raison'] ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="f20_abandon_raison_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="f20_abandon_raison_date" name="f20_abandon_raison_date" value="<?= $abandon['f20_abandon_raison_date'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="f20_abandon_solution" class="form-label">Solution apportée</label>
                            <textarea class="form-control" id="f20_abandon_solution" name="f20_abandon_solution" rows="3" required><?= $abandon['f20_abandon_solution'] ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="f20_abandon_solution_date" class="form-label">Date de la solution</label>
                            <input type="date" class="form-control" id="f20_abandon_solution_date" name="f20_abandon_solution_date" value="<?= $abandon['f20_abandon_solution_date'] ?>" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                    <?php
                    break;

            case 'view':
            default:
                $abandonItems = $controller->index();
                ?>
                <h2>Liste des dossiers problématiques</h2>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Numéro</th>
                            <th>Titre</th>
                            <th>Date de Début</th>
                            <th>Date de Fin</th>
                            <th>Problème</th>
                            <th>Solution</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
                <a href="?page=manageAbondon&action=add">Ajouter un nouveau</a>
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