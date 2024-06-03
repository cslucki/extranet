
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">

   <p>Fichier : <?php echo htmlspecialchars($filePath); ?></p>
    <iframe id="pdf-viewer" src="<?php echo htmlspecialchars($filePath); ?>" width="100%" height="600px"></iframe>
    <a href="javascript:history.back()">Retour</a>


</div>