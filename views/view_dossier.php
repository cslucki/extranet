<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($dossier['titre']); ?></h1>
                <h2><?php echo htmlspecialchars($dossier['prenom'] . ' ' . $dossier['nom']); ?></h2>
                <p><strong>Statut :</strong> <?php echo htmlspecialchars($dossier['statut']); ?></p>
                <p><strong>Dossier terminé :</strong> <?php echo $dossier['f10_dossier_termine'] == 'Y' ? '✔️' : '❌'; ?></p>
                <b>Organisation de la formation</b>
                <p><strong>Dates formation :</strong> <?php echo htmlspecialchars($dossier['date_debut_formation'] . ' - ' . $dossier['date_fin_formation']); ?></p>
                <p><strong>Convocation :</strong> <?php echo htmlspecialchars($dossier['date_convocation']); ?></p>
                <p><strong>Séances faites :</strong> <?php echo htmlspecialchars($dossier['nbre_seances_faites']); ?></p>
                <h2>Check-list de la formation</h2>
                <p><strong>Entretien préalable :</strong> <?php echo $dossier['p10_brief_formation'] == 'Y' ? '✔️' : '❌'; ?></p>
                <p><strong>Individualisation de la formation :</strong> <?php echo $dossier['p20_individualisation'] == 'Y' ? '✔️' : '❌'; ?></p>
                <p><strong>Entreprise créée :</strong> <?php echo $dossier['p30_ae_cree'] == 'Y' ? '✔️' : '❌'; ?></p>
                <p><strong>Attestation de CFP obtenue :</strong> <?php echo $dossier['p40_attestation_cfp'] == 'Y' ? '✔️' : '❌'; ?></p>
                <p><strong>Demande de financement effectuée :</strong> <?php echo $dossier['p50_demande_pec'] == 'Y' ? '✔️' : '❌'; ?></p>
                <p><strong>Financement obtenu :</strong> <?php echo $dossier['p60_pec_ok'] == 'Y' ? '✔️' : '❌'; ?></p>
            </div>
            <!-- Colonne de droite -->
            <div class="col-md-6">
                <h2>Evaluations</h2>
                <p><strong>Evaluation sommative :</strong> <?php echo htmlspecialchars($dossier['date_fin_formation']); ?></p>
                <p><strong>Evaluation à froid :</strong> envoyé le <?php echo htmlspecialchars($dossier['date_envoi_evaluation']); ?> - évaluation le <?php echo htmlspecialchars($dossier['date_evaluation']); ?></p>
                <p><strong>Attentes formation :</strong> <?php echo htmlspecialchars($dossier['attentes_formation']); ?></p>
                <h2>Informations sur la prise en charge des formations</h2>
                <p><strong>Date devis :</strong> <?php echo htmlspecialchars($dossier['date_devis']); ?></p>
                <p><strong>Signé le :</strong> <?php echo !empty($dossier['date_devis_signe']) ? htmlspecialchars($dossier['date_devis_signe']) : 'Non signé'; ?></p>
                <p><strong>Date prise en charge :</strong> <?php echo htmlspecialchars($dossier['date_pec']); ?> sous le numéro <?php echo htmlspecialchars($dossier['pec_numero']); ?></p>
                <h2>Gestion comptable du dossier</h2>
                <p><strong>Chèque de caution :</strong> <?php echo !empty($dossier['date_cheque_caution_recu']) ? htmlspecialchars($dossier['date_cheque_caution_recu']) : 'Non reçu'; ?></p>
                <p><strong>Attestation de fin de formation envoyée le :</strong> <?php echo !empty($dossier['date_envoi_attestation']) ? htmlspecialchars($dossier['date_envoi_attestation']) : 'Non envoyée'; ?></p>
                <p><strong>Confirmation réception attestation par le stagiaire :</strong> <?php echo !empty($dossier['attestation_recu']) ? htmlspecialchars($dossier['attestation_recu']) : 'Non confirmé'; ?></p>
                <p><strong>Moyen de paiement :</strong> <?php echo $dossier['payment_method'] == 'CH' ? 'Par chèque' : 'Virement bancaire'; ?></p>
                <p><strong>Date fonds reçus par le stagiaire :</strong> <?php echo !empty($dossier['date_fond_recu_par_stagiaire']) ? htmlspecialchars($dossier['date_fond_recu_par_stagiaire']) : 'Fonds non reçus'; ?></p>
                <p><strong>Date solde du dossier :</strong> <?php echo !empty($dossier['date_solde_dossier']) ? htmlspecialchars($dossier['date_solde_dossier']) : 'Solde non effectué'; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=dossiers" class="btn btn-primary">Retour aux dossiers</a>
</div>