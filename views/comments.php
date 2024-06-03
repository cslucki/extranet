<div class="container">
    <h1>Commentaires</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>Liste des Commentaires</h2>
            <table id="commentsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Nombre de Commentaires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($comment['id_formation_dossiers']); ?></td>
                            <td><?php echo htmlspecialchars($comment['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($comment['nom']); ?></td>
                            <td><?php echo htmlspecialchars($comment['comment_count']); ?></td>
                            <td>
                                <a href="?page=lm_comments&action=view_comments&id=<?php echo $comment['id_formation_dossiers']; ?>" class="btn btn-primary">Voir les commentaires</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Détails des Commentaires</h2>
            <?php if (isset($dossier_comments)): ?>
                <table id="dossierCommentsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dossier_comments as $comment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($comment['date']); ?></td>
                                <td><?php echo htmlspecialchars($comment['comments']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Sélectionnez un dossier pour voir les commentaires.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commentsTable = new simpleDatatables.DataTable("#commentsTable");
        const dossierCommentsTable = new simpleDatatables.DataTable("#dossierCommentsTable");
    });
</script>