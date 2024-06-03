<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Entretiens préalables
    </div>
    <div class="card-body">
        <?php
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $controller = new FormationQuestionnaireController();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($action === 'store') {
                $controller->storeFormationQuestionnaire();
            } elseif ($action === 'update' && $id) {
                $controller->updateFormationQuestionnaire($id);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'delete' && $id) {
            $controller->deleteFormationQuestionnaire($id);
        }

        switch ($action) {
            case 'add':
                ?>
                <h2>Ajouter un Questionnaire Avant</h2>
                <form method="post" action="?page=formationQuestionnaire&action=store">
                    <input type="text" name="id_formation_dossiers" placeholder="ID Formation Dossiers" required><br>
                    <select name="participation_prealable">
                        <option value="OUI">Oui</option>
                        <option value="NON">Non</option>
                    </select><br>
                    <select name="date_debut_souhaitee">
                        <option value="Dès que possible">Dès que possible</option>
                        <option value="Dans 15 jours">Dans 15 jours</option>
                        <option value="Dans 1 mois">Dans 1 mois</option>
                    </select><br>
                    <textarea name="attentes_formation" placeholder="Attentes de la formation"></textarea><br>
                    <button type="submit">Ajouter</button>
                </form>
                <?php
                break;

            case 'edit':
                $questionnaire = $controller->editFormationQuestionnaire($id);
                ?>
                <h2>Modifier le Questionnaire Avant</h2>
                <form method="post" action="?page=formationQuestionnaire&action=update&id=<?= $id ?>">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="text" name="id_formation_dossiers" value="<?= $questionnaire['id_formation_dossiers'] ?>" required><br>
                    <select name="participation_prealable">
                        <option value="OUI" <?php if ($questionnaire['participation_prealable'] == 'OUI') echo 'selected'; ?>>Oui</option>
                        <option value="NON" <?php if ($questionnaire['participation_prealable'] == 'NON') echo 'selected'; ?>>Non</option>
                    </select><br>
                    <select name="date_debut_souhaitee">
                        <option value="Dès que possible" <?php if ($questionnaire['date_debut_souhaitee'] == 'Dès que possible') echo 'selected'; ?>>Dès que possible</option>
                        <option value="Dans 15 jours" <?php if ($questionnaire['date_debut_souhaitee'] == 'Dans 15 jours') echo 'selected'; ?>>Dans 15 jours</option>
                        <option value="Dans 1 mois" <?php if ($questionnaire['date_debut_souhaitee'] == 'Dans 1 mois') echo 'selected'; ?>>Dans 1 mois</option>
                    </select><br>
                    <textarea name="attentes_formation"><?= $questionnaire['attentes_formation'] ?></textarea><br>
                    <button type="submit">Modifier</button>
                </form>
                <?php
                break;

            case 'view':
            default:
                $questionnaires = $controller->index();
                ?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Participation</th>
                            <th>Date Début Souhaitée</th>
                            <th>Attentes Formation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <?php foreach ($questionnaires as $item): ?>
                        <tr>
                            <td><?= $item['id_formation_dossiers'] ?></td>
                            <td><?= $item['prenom'] ?></td>
                            <td><?= $item['nom'] ?></td>
                            <td><?= $item['participation_prealable'] ?></td>
                            <td><?= $item['date_debut_souhaitee'] ?></td>
                            <td><?= $item['attentes_formation'] ?></td>
                            <td>
                                <a href="?page=formationQuestionnaire&action=edit&id=<?= $item['id_formation_dossiers'] ?>">Modifier</a> -
                                <a href="?page=formationQuestionnaire&action=delete&id=<?= $item['id_formation_dossiers'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <a href="?page=formationQuestionnaire&action=add">Ajouter un nouveau questionnaire</a>
                <?php
                break;
        }
        ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dataTable = new simpleDatatables.DataTable('#datatablesSimple', {
            "perPage": 30
        });
    });
</script>