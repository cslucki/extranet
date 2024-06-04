<!-- views/view_convocation.php -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">
        <p><strong>Date :</strong> <?php echo htmlspecialchars($convocation['date_convocation']); ?></p>
        <p>Bonjour <?php echo htmlspecialchars($convocation['prenom'] . ' ' . strtoupper($convocation['nom'])); ?>,</p>
        <p>Vous êtes inscrit à la formation <strong><?php echo htmlspecialchars($convocation['numero']); ?> - <?php echo htmlspecialchars($convocation['titre']); ?></strong>.</p>
        <p>La formation aura lieu du <strong><?php echo htmlspecialchars($convocation['date_debut_formation']); ?></strong> au <strong><?php echo htmlspecialchars($convocation['date_fin_formation']); ?></strong>.</p>
        <p>Cordialement,</p>
        <p>Cyril SLUCKI</p>
    </div>
</div>

<!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=viewDossier&id=<?php echo $convocation['id_formation_dossiers']; ?>" class="btn btn-primary">Retour au dossier</a>
</div>