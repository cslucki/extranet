<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails des Commentaires</title>
</head>
<body>
    <h1>Détails des Commentaires</h1>
    <?php if (!empty($comments)): ?>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li><?php echo htmlspecialchars($comment['comment_text']); ?> (Posté le <?php echo htmlspecialchars($comment['created_at']); ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun commentaire trouvé pour ce GUID.</p>
    <?php endif; ?>
</body>
</html>