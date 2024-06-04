<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <!-- début de la section -->
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h6 class="card-title"><strong>Formation :</strong> <?php echo htmlspecialchars($dossier['titre']); ?></h6>
            </div>
            <div class="col-md-6">
                <h5 class="card-text"><strong>Stagiaire :</strong> <?php echo htmlspecialchars($dossier['prenom'] . ' ' . $dossier['nom']); ?></h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="card-text"><strong>Statut :</strong> <?php echo htmlspecialchars($dossier['statut']); ?></p>
            </div>
            <div class="col-md-6">
                <p class="card-text"><strong>Début de formation :</strong> <?php echo htmlspecialchars($dossier['date_debut_formation']); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="card-text"><strong>Fin de formation :</strong> <?php echo htmlspecialchars($dossier['date_fin_formation']); ?></p>
            </div>
            <div class="col-md-6">
                <p class="card-text"><strong>Date PEC :</strong> <?php echo htmlspecialchars($dossier['date_pec']); ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="card-text"><strong>Numéro PEC :</strong> <?php echo htmlspecialchars($dossier['pec_numero']); ?></p>
            </div>
        </div>
    </div>
    <!-- fin de la section -->
</div>

<!-- Section pour le bouton de retour -->
<div class="d-flex justify-content-center mb-4">
    <a href="index.php?page=dossiers" class="btn btn-primary">Retour aux dossiers</a>
</div>