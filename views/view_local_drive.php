<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">
    <ul class="pdf-list">
        <?php if (!empty($pdfFiles)): ?>
            <?php foreach ($pdfFiles as $pdfFileUrl): ?>
                <li>
                    <a href="index.php?page=viewPdfContent&file=<?php echo urlencode($pdfFileUrl); ?>"><?php echo basename($pdfFileUrl); ?></a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucun fichier PDF trouvé.</li>
        <?php endif; ?>
    </ul>
    <a href="javascript:history.back()">Retour</a>



    </div>
</div>
