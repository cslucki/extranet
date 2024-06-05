


<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?>


            <div class="container">
                <div class="row">
                    <div class="col-6 text-start">
                    <!-- Contenu pour la colonne de gauche -->
                    
        
        <b>Com</b> : <a href=http://cyberworkers.com/cybber/partners/finder.php?action=finder&requete=<?php echo $dossier['login']; ?>&type=1&df=1>Saisie</a> - 
        <a href=/index.php?page=view_comments&id_guid=<?php echo $dossier['id_guid']; ?>>Voir</a>

        | <b>Documents</b> : 
                <?php 
                if ($fileUrls['devis']) {
                    echo '<a href="' . htmlspecialchars($fileUrls['devis']) . '" target="_blank">Convention</a> - ';
                } else {
                    //echo 'Aucun fichier Devis.pdf trouvé.';
                }
                ?>
                <?php 
                if ($fileUrls['pec']) {
                    echo '<a href="' . htmlspecialchars($fileUrls['pec']) . '" target="_blank">PEC</a> - ';
                } else {
                    //echo 'Aucun fichier PEC.pdf trouvé.';
                }
                ?>
                
                <?php 
                if ($fileUrls['attestation']) {
                    echo '<a href="' . htmlspecialchars($fileUrls['attestation']) . '" target="_blank">Attestation</a> - ';
                } else {
                // echo 'Aucun fichier Attestation.pdf trouvé.';
                }
                ?>
       <a href=/index.php?page=viewLocalDrive&id=<?php echo $dossier['id_formation_dossiers']; ?>>Voir dossier</a>
   
                    </div>
                    <div class="col-6 text-end">
                    <!-- Contenu pour la colonne de droite -->
                    <?php if ($previousId): ?>
        <a href="index.php?page=viewDossier&id=<?php echo $previousId; ?>">Précédent</a> -
    <?php endif; ?>
    <?php if ($nextId): ?>
        <a href="index.php?page=viewDossier&id=<?php echo $nextId; ?>" >Suivant</a>
    <?php endif; ?>
                    </div>
                </div>
                </div>

        
 

     </div>
    <div class="card-body">
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Formation : <?php echo htmlspecialchars($dossier['titre']); ?></h5>
                        <h4>Bénéficiaire : <?php echo $dossier['prenom'] . ' ' . $dossier['nom']; ?></h4>
                    </div>
                    <div class="card-body">
                        <p>
                        <strong>Dossier :</strong> <?php echo htmlspecialchars($dossier['id_formation_dossiers']); ?> - 
                        <strong>Statut :</strong> <?php echo htmlspecialchars($dossier['statut']); ?>
                        <?php if ($dossier['f20_abandon'] == 'Y') echo '<p style="color: red;">Dossier problématique</p>'; ?>
                        </p>

                        <p><strong>Nombre de séances faites :</strong> <?php echo htmlspecialchars($dossier['nbre_seances_faites']); ?> - <a href="<?php echo $dossier['adresse_url_support']; ?>" target="_blank">Voir le Drive de formation</a>

                        <p><strong>Dossier terminé :</strong> 
                            <?php echo $dossier['f10_dossier_termine'] == 'Y' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'; ?>

                            - <a href="/index.php?page=view_certificat&id=<?php echo $dossier['id_formation_dossiers']; ?>">Voir le certificat de réalisation</a>

                            
                        </p>
                        <p><strong>Dates formation :</strong> <?php echo htmlspecialchars($dossier['date_debut_formation'] . ' au ' . $dossier['date_fin_formation']); ?></p>
                        <p>
                            <strong>Convocation :</strong> <?php echo htmlspecialchars($dossier['date_convocation']); ?> - 
                             <a href="/index.php?page=view_convocation&id=<?php echo $dossier['id_formation_dossiers']; ?>">Voir la convocation</a>
                        </p>
                        
                    
                    </p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Check-list de la formation</h5>
                    </div>
                    <div class="card-body">
                    <p><strong>Entretien préalable :</strong> 
                    <?php 
                    if ($dossier['p10_brief_formation'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                        echo ' - <a href="/index.php?page=formationQuestionnaire&action=view_detail&id=' . $dossier['id_formation_dossiers'] . '">Voir l\'entretien préalable</a>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
                </p>

                <p><strong>Individualisation de la formation :</strong> 
                    <?php 
                    if ($dossier['p20_individualisation'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
                </p>

                <p><strong>Entreprise créée :</strong> 
                    <?php 
                    if ($dossier['p30_ae_cree'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
                </p>

                <p><strong>Attestation URSSAF :</strong> 
                    <?php 
                    if ($dossier['p40_attestation_cfp'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
                </p>

                <p><strong>Demande de financement  :</strong> 
                    <?php 
                    if ($dossier['p50_demande_pec'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
                </p>

                <p><strong>Financement accordé :</strong> 
                    <?php 
                    if ($dossier['p60_pec_ok'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
                </p>

                <p><strong>Certificat de fin de formation :</strong> 
                    <?php 
                    if ($dossier['p70_certificat_fin'] == 'Y') {
                        echo '<i class="fas fa-check"></i>';
                    } else {
                        echo '<i class="fas fa-times"></i>';
                    }
                    ?>
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
                        <p><strong>Evaluation sommative :</strong> <?php echo htmlspecialchars($dossier['date_fin_formation']); ?> - <a href="/index.php?page=view_pre_evaluation&id=<?php echo $dossier['id_formation_dossiers']; ?>">Voir l'évaluation</a></p>
                        <p><strong>Evaluation à froid :</strong> demandée le <?php echo htmlspecialchars($dossier['date_envoi_evaluation']); ?> - effectuée le <?php echo htmlspecialchars($dossier['date_evaluation']); ?></p>
                        <ul>
                            <li>Note : <?php echo $dossier['eval_note']; ?>
                            <li><a href="/index.php?page=view_evaluation&id=<?php echo $dossier['id_formation_dossiers']; ?>">Voir l'évaluation à froid</a>
                        </ul>
                        <p><strong>Attentes avant la formation :</strong> <?php echo htmlspecialchars($dossier['attentes_formation']); ?></p>
                        <p><strong>Suggestions évaluation sommative :</strong> <?php echo htmlspecialchars($dossier['pre_eval_note']); ?></p>
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
                        <?php
                        /*
                        <p><strong>Date fonds reçus par le stagiaire :</strong> <?php echo htmlspecialchars($dossier['date_fond_recu_par_stagiaire'] ?: 'Fonds non reçus'); ?></p>
                        <p><strong>Date solde du dossier :</strong> <?php echo htmlspecialchars($dossier['date_solde_dossier'] ?: 'Solde non effectué'); ?></p>
                        */
                        ?>
                    </div>
                </div>
                <?php
                    /*
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Documents</h5>
                    </div>
                    <div class="card-body">
                    
                    if ($fileUrls['devis']) {
                        echo '<p><strong>Devis :</strong> <a href="' . htmlspecialchars($fileUrls['devis']) . '" target="_blank">Voir le Devis.pdf</a></p>';
                    } else {
                        echo '<p><strong>Devis :</strong> Aucun fichier Devis.pdf trouvé.</p>';
                    }
                    
                    if ($fileUrls['pec']) {
                        echo '<p><strong>PEC :</strong> <a href="' . htmlspecialchars($fileUrls['pec']) . '" target="_blank">Voir le PEC.pdf</a></p>';
                    } else {
                        echo '<p><strong>PEC :</strong> Aucun fichier PEC.pdf trouvé.</p>';
                    }
                    
                    if ($fileUrls['attestation']) {
                        echo '<p><strong>Attestation :</strong> <a href="' . htmlspecialchars($fileUrls['attestation']) . '" target="_blank">Voir l\'Attestation.pdf</a></p>';
                    } else {
                        echo '<p><strong>Attestation :</strong> Aucun fichier Attestation.pdf trouvé.</p>';
                    }
                   
               
                    </div>
                    
                </div>
                 */
                ?>
            </div>
        </div>
        
        <!-- Section pour le bouton de retour -->
        <div class="d-flex justify-content-center mb-4">
            <a href="index.php?page=dossiers" class="btn btn-primary">Retour aux dossiers</a>
        </div>
    </div>
</div>