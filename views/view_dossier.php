<div class="card">
    <div class="card-header">
        Détails du Dossier de Formation
    </div>
    <div class="card-body">
        <h5 class="card-title">Formation : <?php echo htmlspecialchars($dossier['titre']); ?></h5>
        <p class="card-text">Stagiaire : <?php echo htmlspecialchars($dossier['prenom'] . ' ' . $dossier['nom']); ?></p>
        <p class="card-text">Statut : <?php echo htmlspecialchars($dossier['statut']); ?></p>
        <p class="card-text">Début de formation : <?php echo htmlspecialchars($dossier['date_debut_formation']); ?></p>
        <p class="card-text">Fin de formation : <?php echo htmlspecialchars($dossier['date_fin_formation']); ?></p>

        <p class="card-text">Date PEC : <?php echo htmlspecialchars($dossier['date_pec']); ?></p>
        <p class="card-text">Numéro PEC : <?php echo htmlspecialchars($dossier['pec_numero']); ?></p>
        <!-- Ajoutez plus de détails selon le besoin -->
        <a href="index.php?page=dossiers" class="btn btn-primary">Retour aux dossiers</a>
    </div>
</div>
