        <div class="card mb-4">
            <div class="card-body">
                <p class="mb-0">
                  
                
                <h1 class="mt-5">Bienvenue sur l'application Extranet</h1>
        
        <div class="card mt-4">
            <div class="card-header">
                Statistiques des dossiers de formation
            </div>
            <div class="card-body">
                <p><strong>Nombre total de dossiers de formation :</strong> <?php echo $totalDossiers; ?></p>
                <h5>Sous-totaux par année :</h5>
                <ul>
                    <?php foreach ($dossiersByYear as $yearData) : ?>
                        <li><?php echo $yearData['annee_comptabilisation']; ?> : <?php echo $yearData['total']; ?> dossiers</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>



                </p>
            </div>
        </div>

