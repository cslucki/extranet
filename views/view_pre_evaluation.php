<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar-alt me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">

        <p>Date : <?php echo htmlspecialchars($dossier['date_fin_formation']); ?></p>
        <p>Stagiaire : <?php echo htmlspecialchars($dossier['prenom'] . ' ' . $dossier['nom']); ?></p>
        <p>Formation : <?php echo htmlspecialchars($dossier['numero'] . ' - ' . $dossier['titre']); ?></p>
        <table class="table">
            <tbody>
                <tr>
                    <th>Accueil</th>
                    <td><?php echo htmlspecialchars($dossier['pre_eval1']); ?></td>
                </tr>
                <tr>
                    <th>Formateur</th>
                    <td><?php echo htmlspecialchars($dossier['pre_eval2']); ?></td>
                </tr>
                <tr>
                    <th>Accompagnement</th>
                    <td><?php echo htmlspecialchars($dossier['pre_eval3']); ?></td>
                </tr>
                <tr>
                    <th>Contenu</th>
                    <td><?php echo htmlspecialchars($dossier['pre_eval4']); ?></td>
                </tr>
                <tr>
                    <th>Moyens mis en œuvre</th>
                    <td><?php echo htmlspecialchars($dossier['pre_eval5']); ?></td>
                </tr>
            </tbody>
        </table>
        <p><b>Suggestions</b> : <?php echo htmlspecialchars($dossier['pre_eval_note']); ?></p>
    </div>
</div>

    
    <!-- Section pour le bouton de retour -->
    <div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=viewDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>" class="btn btn-primary">Retour au dossier</a>
</div>