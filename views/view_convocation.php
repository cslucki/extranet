<!-- views/view_convocation.php -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">
        <p><strong>Date :</strong> <?php echo htmlspecialchars($convocation['date_convocation']); ?></p>
        <p><strong>Objet :</strong> Convocation début de formation</p>

        <p>Bonjour <?php echo htmlspecialchars($convocation['prenom'] . ' ' . strtoupper($convocation['nom'])); ?>,</p>
        <p>Vous êtes inscrit à la formation "<strong><?php echo htmlspecialchars($convocation['numero']); ?> - <?php echo htmlspecialchars($convocation['titre']); ?></strong>".</p>
        <p>La formation aura lieu du <strong><?php echo htmlspecialchars($convocation['date_debut_formation']); ?></strong> au <strong><?php echo htmlspecialchars($convocation['date_fin_formation']); ?></strong>.</p>
        <p>Comme convenu lors de la séance de préparation, je vous contacterai par téléphone, 15 minutes avant l'heure prévue, pour vous guider.</p>
        <p>Sinon depuis <a href=https://calendar.google.com/>Google Agenda</a>, connectez-vous à la visioconférence ou appelez moi au <a href=+33637931282>06 37 93 12 82</a>.</p>
        <p>Voici le <a href=https://calendar.app.google/VqBUBa6iZv8Ztjh37>lien pour faire un report de séance<a/>.</p>
        <p>Cordialement,</p>
        <p>Cyril SLUCKI</p>
    </div>
</div>

<!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=viewDossier&id=<?php echo $convocation['id_formation_dossiers']; ?>" class="btn btn-primary">Retour au dossier</a>
</div>