
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Détails des entretiens
    </div>
    <div class="card-body">
        <?php if (!empty($comments)): ?>
            <div class="list-group">
                <?php foreach ($comments as $comment): ?>
                    <div class="list-group-item">
                        <h5 class="mb-1">Commentaire du <?php echo htmlspecialchars($comment['date']); ?></h5>
                        <div class="mb-1"><?php echo $comment['comments']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">Aucun commentaire trouvé pour ce GUID.</p>
        <?php endif; ?>
    </div>
</div>
   