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
        <p>Je vous souhaite la bienvenue à cette formation que vous débutez ce jour à 9 heures.</p>
        <p>
            Nom de la formation : "<strong><?php echo htmlspecialchars($convocation['numero']); ?> - <?php echo htmlspecialchars($convocation['titre']); ?></strong>"
            (du <?php echo htmlspecialchars($convocation['date_debut_formation']); ?></strong> au <?php echo htmlspecialchars($convocation['date_fin_formation']); ?>).</p>
        <p>Pour accèder à cette formation : 
            <ul>
                <li>Se connecter via <a href=https://calendar.google.com/>Google Agenda</a> (depuis un ordinateur ou un smartphone)</li>
                <li>Et/ou consultez l'email envoyé par Google Agenda</li>
                <li>Cliquez sur "Participer avec Google Meet"</li>
            </ul>
        <p>Comme convenu lors de la séance de préparation, je vous contacterai par téléphone, 15 minutes avant l'heure prévue.</p>
        <p>Pour faire un <a href=https://calendar.app.google/VqBUBa6iZv8Ztjh37>report de séance<a/>.</p>
        <p>Cordialement,</p>
        <p>Cyril SLUCKI</p>
        <p>06 37 93 12 82</p>
    </div>
</div>

<!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=viewDossier&id=<?php echo $convocation['id_formation_dossiers']; ?>" class="btn btn-primary">Retour au dossier</a>
</div>