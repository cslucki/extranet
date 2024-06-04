<!-- views/view_convocation.php -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-1"></i>
        <?php echo $page_title; ?> - Généré depuis <a href=https://amteletravail.fr/monespace/questionnaire-avis/>via formulaire</a>
    </div>
    <div class="card-body">
            <p class="card-title"><strong>Formation :</strong> <?= htmlspecialchars($dossier['numero']) ?> - <?= htmlspecialchars($dossier['titre']) ?></p>
            <p class="card-text"><strong>Date :</strong> <?= htmlspecialchars($dossier['date_fin_formation']) ?></p>
            <p class="card-text"><strong>Stagiaire :</strong> <?= htmlspecialchars($dossier['prenom']) ?> <?= htmlspecialchars($dossier['nom']) ?></p>
            <h2 class="mt-4">Note sur 5 : <?= htmlspecialchars($dossier['eval_note']) ?></h2>
            <h5 class="mt-4">Quelles sont les compétences que vous avez pu acquérir ?</h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($dossier['eval1'])) ?></p>
            <h5 class="mt-4">Points positifs de la formation</h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($dossier['eval2'])) ?></p>
            <h5 class="mt-4">Points négatifs de la formation et/ou suggestions d’amélioration</h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($dossier['eval3'])) ?></p>

            </div>

        </div>
    
    <!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=viewDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>" class="btn btn-primary">Retour au dossier</a>
</div>