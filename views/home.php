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
                    <p><strong>Moyenne des notes de formation :</strong> <?php echo number_format($averageEvalNote, 2); ?></p>
                    
                    <h5>Sous-totaux par type de formation toutes années confondues :</h5>
                    <ul>
                        <?php foreach ($formationsSubtotal as $formation) : ?>
                            <li>
                                <a href="index.php?page=dossiers&formation_id=<?php echo $formation['id_formation_catalogue']; ?>">
                                    <?php echo $formation['numero']; ?> - <?php echo $formation['titre']; ?> : <?php echo $formation['total']; ?> dossiers
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <h5>Sous-totaux par année et par type de formation :</h5>
                    <ul>
                        <?php foreach ($dossiersByYearAndType as $yearTypeData) : ?>
                            <li>
                                <a href="index.php?page=dossiers&formation_id=<?php echo $yearTypeData['id_formation_catalogue']; ?>&annee=<?php echo $yearTypeData['annee_comptabilisation']; ?>">
                                    <?php echo $yearTypeData['annee_comptabilisation']; ?> - <?php echo $yearTypeData['numero']; ?> - <?php echo $yearTypeData['titre']; ?> : <?php echo $yearTypeData['total']; ?> dossiers
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <h5>Sous-totaux par année :</h5>
                    <ul>
                        <?php foreach ($dossiersByYear as $yearData) : ?>
                            <li>
                                <a href="index.php?page=dossiers&annee=<?php echo $yearData['annee_comptabilisation']; ?>">
                                    <?php echo $yearData['annee_comptabilisation']; ?> : <?php echo $yearData['total']; ?> dossiers
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
    <h5>Sous-totaux par année :</h5>
                    <ul>
                        <?php foreach ($dossiersByYear as $yearData) : ?>
                            <li>
                                <a href="index.php?page=dossiers&annee=<?php echo $yearData['annee_comptabilisation']; ?>">
                                    <?php echo $yearData['annee_comptabilisation']; ?> : <?php echo $yearData['total']; ?> dossiers
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </p>
    </div>
</div>