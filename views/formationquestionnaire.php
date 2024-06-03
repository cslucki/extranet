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
                <h2>Ajouter un entretien préalable</h2>
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
                    
                    <?php
                    $competences = ['competence1', 'competence2', 'competence3', 'competence4', 'competence5', 'competence6'];
                    $options = ['Acquise', 'En cours d\'acquisition', 'À acquérir'];
                    foreach ($competences as $competence) {
                        echo "<label for='$competence'>" . ucfirst($competence) . "</label><br>";
                        echo "<select name='$competence'>";
                        foreach ($options as $option) {
                            echo "<option value='$option'>$option</option>";
                        }
                        echo "</select><br>";
                    }
                    ?>
                    
                    <button type="submit">Ajouter</button>
                </form>
                <?php
                break;

            case 'edit':
                $questionnaire = $controller->editFormationQuestionnaire($id);
                ?>
                <h2>Modifier l'Entretien préalable</h2>
                <div>
                    <strong>ID Formation Dossiers:</strong> <?= $questionnaire['id_formation_dossiers'] ?><br>
                    <strong>Prénom:</strong> <?= $questionnaire['prenom'] ?><br>
                    <strong>Nom:</strong> <?= $questionnaire['nom'] ?><br>
                    <strong>Numéro de la formation:</strong> <?= $questionnaire['numero'] ?><br>
                    <strong>Titre de la formation:</strong> <?= $questionnaire['titre'] ?><br>
                </div>

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
                    
                    <?php
                    $competences = ['competence1', 'competence2', 'competence3', 'competence4', 'competence5', 'competence6'];
                    $options = ['Acquise', 'En cours d\'acquisition', 'À acquérir'];
                    foreach ($competences as $competence) {
                        echo "<label for='$competence'>" . ucfirst($competence) . "</label><br>";
                        echo "<select name='$competence'>";
                        foreach ($options as $option) {
                            $selected = ($questionnaire[$competence] == $option) ? 'selected' : '';
                            echo "<option value='$option' $selected>$option</option>";
                        }
                        echo "</select><br>";
                    }
                    ?>
                    
                    <button type="submit">Modifier</button>
                </form>
                <?php
                break;

            case 'view_detail':
                $questionnaire = $controller->viewDetailFormationQuestionnaire($id);
                ?>
                <h2>Détail de l'entretien préalable</h2>
                <div>
                    <strong>ID Formation Dossiers:</strong> <?= $questionnaire['id_formation_dossiers'] ?><br>
                    <strong>Prénom:</strong> <?= $questionnaire['prenom'] ?><br>
                    <strong>Nom:</strong> <?= $questionnaire['nom'] ?><br>
                    <strong>Numéro de la formation:</strong> <?= $questionnaire['numero'] ?><br>
                    <strong>Titre de la formation:</strong> <?= $questionnaire['titre'] ?><br>
                    <strong>Participation Préalable:</strong> <?= $questionnaire['participation_prealable'] ?><br>
                    <strong>Date Début Souhaitée:</strong> <?= $questionnaire['date_debut_souhaitee'] ?><br>
                    <strong>Attentes Formation:</strong> <?= $questionnaire['attentes_formation'] ?><br>
                    <strong>Compétence 1:</strong> <?= $questionnaire['competence1'] ?><br>
                    <strong>Compétence 2:</strong> <?= $questionnaire['competence2'] ?><br>
                    <strong>Compétence 3:</strong> <?= $questionnaire['competence3'] ?><br>
                    <strong>Compétence 4:</strong> <?= $questionnaire['competence4'] ?><br>
                    <strong>Compétence 5:</strong> <?= $questionnaire['competence5'] ?><br>
                    <strong>Compétence 6:</strong> <?= $questionnaire['competence6'] ?><br>
                </div>
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
                    <tbody>
                        <?php foreach ($questionnaires as $item): ?>
                            <tr>
                                <td><?= $item['id_formation_dossiers'] ?></td>
                                <td><?= $item['prenom'] ?></td>
                                <td><?= $item['nom'] ?></td>
                                <td><?= $item['participation_prealable'] ?></td>
                                <td><?= $item['date_debut_souhaitee'] ?></td>
                                <td><?= $item['attentes_formation'] ?></td>
                                <td>
                                <a href="?page=formationQuestionnaire&action=view_detail&id=<?= $item['id_formation_dossiers'] ?>">Voir</a> -
                                <a href="?page=formationQuestionnaire&action=edit&id=<?= $item['id_formation_dossiers'] ?>">Modifier</a> -
                                <a href="?page=formationQuestionnaire&action=delete&id=<?= $item['id_formation_dossiers'] ?>">Supprimer</a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="?page=formationQuestionnaire&action=add">Ajout d’un entretien préalable</a>
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