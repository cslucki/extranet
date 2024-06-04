<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?><br>
        <a href=/index.php?page=view_comments&id_guid=<?php echo $dossier['id_guid']; ?>>Communications</a> - 
        <a href=/index.php?page=formationQuestionnaire&action=view_detail&id=<?php echo $dossier['id_formation_dossiers']; ?>>Entretien préalable</a> - 
        <a href=/index.php?page=viewLocalDrive&id=<?php echo $dossier['id_formation_dossiers']; ?>>Documents</a> - 
    
   
    
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Nom de la formation : <?php echo htmlspecialchars($dossier['titre']); ?></h4>
                        <h5>Nom du stagiaire : <?php echo htmlspecialchars($dossier['prenom'] . ' ' . $dossier['nom']); ?></h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Statut :</strong> <?php echo htmlspecialchars($dossier['statut']); ?></p>
                        <p><strong>Dossier terminé :</strong> 
                            <?php echo $dossier['f10_dossier_termine'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
          
                        <p><strong>Dates formation :</strong> <?php echo htmlspecialchars($dossier['date_debut_formation'] . ' - ' . $dossier['date_fin_formation']); ?></p>
                        <p>
                            <strong>Convocation :</strong> <?php echo htmlspecialchars($dossier['date_convocation']); ?> - 
                            <a href=/index.php?page=view_convocation&id=<?php echo $dossier['id_formation_dossiers']; ?>>voir la convocation</a>
                        </p>
                        <p><strong>Séances faites :</strong> <?php echo htmlspecialchars($dossier['nbre_seances_faites']); ?></p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Check-list de la formation</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Entretien préalable :</strong> 
                            <?php echo $dossier['p10_brief_formation'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
                        <p><strong>Individualisation de la formation :</strong> 
                            <?php echo $dossier['p20_individualisation'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
                        <p><strong>Entreprise créée :</strong> 
                            <?php echo $dossier['p30_ae_cree'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
                        <p><strong>Attestation de CFP obtenue :</strong> 
                            <?php echo $dossier['p40_attestation_cfp'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
                        <p><strong>Demande de financement effectuée :</strong> 
                            <?php echo $dossier['p50_demande_pec'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
                        <p><strong>Financement obtenu :</strong> 
                            <?php echo $dossier['p60_pec_ok'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>
                        <p><strong>Certificat de fin de formation :</strong> 
                            <?php echo $dossier['p70_certificat_fin'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>
                        </p>


                    </div>
                </div>
            </div>
            
            <!-- Colonne de droite -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Evaluations</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Evaluation sommative :</strong> <?php echo htmlspecialchars($dossier['date_fin_formation']); ?></p>
                        <p><strong>Evaluation à froid :</strong> envoyé le <?php echo htmlspecialchars($dossier['date_envoi_evaluation']); ?> - évaluation le <?php echo htmlspecialchars($dossier['date_evaluation']); ?></p>
                        <p><strong>Attentes avant la formation :</strong> <?php echo htmlspecialchars($dossier['attentes_formation']); ?></p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Informations sur la prise en charge des formations</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Date devis :</strong> <?php echo htmlspecialchars($dossier['date_devis']); ?></p>
                        <p><strong>Signé le :</strong> <?php echo htmlspecialchars($dossier['date_devis_signe'] ?: 'Non signé'); ?></p>
                        <p><strong>Date prise en charge :</strong> <?php echo htmlspecialchars($dossier['date_pec']); ?> sous le numéro <?php echo htmlspecialchars($dossier['pec_numero']); ?></p>
                    </div> 
                </div> 
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Gestion comptable du dossier</h5>
                    </div>
                    <div class="card-body">            
                        <p><strong>Chèque de caution :</strong> <?php echo htmlspecialchars($dossier['date_cheque_caution_recu'] ?: 'Non reçu'); ?></p>
                        <p><strong>Attestation de fin de formation pour financeur :</strong> <?php echo htmlspecialchars($dossier['date_envoi_attestation'] ?: 'Non envoyée'); ?></p>
   
                        
                        
                        <p><strong>Moyen de paiement :</strong> <?php echo htmlspecialchars($dossier['moyen_paiement'] == 'CH' ? 'Par chèque' : 'Virement bancaire'); ?></p>
                        <p><strong>Date fonds reçus par le stagiaire :</strong> <?php echo htmlspecialchars($dossier['date_fond_recu_par_stagiaire'] ?: 'Fonds non reçus'); ?></p>
                        <p><strong>Date solde du dossier :</strong> <?php echo htmlspecialchars($dossier['date_solde_dossier'] ?: 'Solde non effectué'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section pour le bouton de retour -->
        <div class="d-flex justify-content-center mb-4">
            <a href="index.php?page=dossiers" class="btn btn-primary">Retour aux dossiers</a>
        </div>
    </div>
</div>