<!-- views/view_convocation.php -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">

    <h1>Certificat de réalisation</h1>
        <p><b>Date</b> : <?= htmlspecialchars($dossier['date_fin_formation']) ?></p>
        <p>Je soussigné Camille RAUSCH, représentante légale du dispensateur de l’action concourant au développement des compétences :</p>
        <p>
            <b>ASSOCIATION AMT</b><br>
            31B, rue Espérandieu 13001 Marseille<br>
            Siret : 47874023600029
        </p>
        <br>
        atteste que :
        <br>
        <p>
            <b><?= htmlspecialchars($dossier['prenom']) ?> <?= htmlspecialchars($dossier['nom']) ?></b><br>
            à suivi l’action de formation  : "<?= htmlspecialchars($dossier['titre']) ?>".<br>
            qui s’est déroulée du  du <?= htmlspecialchars($dossier['date_debut_formation']) ?> au <?= htmlspecialchars($dossier['date_fin_formation']) ?> pour une durée de 18 heures.
        </p>
        <p>Sans préjudice des délais imposés par les règles fiscales, comptables ou commerciales, je m’engage à conserver l’ensemble des pièces justificatives qui ont permis d’établir le présent certificat pendant une durée de 3 ans à compter de la fin de l’année du dernier paiement. En cas de cofinancement des fonds européens, la durée de conservation est étendue conformément aux obligations conventionnelles spécifiques.</p>
        <p>Nature de l’action concourant au développement des compétences : Action de formation</p>
        <p>Fait à Marseille, le <?= htmlspecialchars($dossier['date_fin_formation']) ?></p>
        <p>
            <b>Certifié exact par l’organisme.</b><br>
            Signature et cachet de l’organisme de formation : <br>
            <img src="/assets/images/signature.png" alt="Signature">
        </p>

        



    </div>
</div>

<!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=viewDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>" class="btn btn-primary">Retour au dossier</a>
</div>