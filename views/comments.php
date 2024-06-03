<div class="container">

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
                                <a href="http://extranet/index.php?page=view_comments&id_guid=<?php echo $comment['id_guid']; ?>" class="btn btn-primary">Voir les commentaires</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
 
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commentsTable = new simpleDatatables.DataTable("#commentsTable");
        // const dossierCommentsTable = new simpleDatatables.DataTable("#dossierCommentsTable");
    });
</script>