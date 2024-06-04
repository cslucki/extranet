<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <?php echo $page_title; ?>
    </div>
    <div class="card-body">
    <!-- formulaire pour sélectionner tous les dossiers -->
    <form action="index.php?page=processDossierActions" method="post">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>ID</th>
                        <th>Stagiaire</th>
                        <th>Formation</th>
                        <th>Statut</th>
                        <th>BPF</th>
                        <th>Convoc</th>
                        <th>Devis</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Envoi eval</th>
                        <th>Eval</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $dossier) : ?>
                    <tr>
                        <td><input type="checkbox" name="selected_dossiers[]" value="<?php echo $dossier['id_formation_dossiers']; ?>"></td>
                        <td><?php echo $dossier['id_formation_dossiers']; ?></td>
                        <td><?php echo $dossier['prenom'] . ' ' . $dossier['nom'] . ' - ' . $dossier['login']; ?></td>
                        <td><?php echo $dossier['formation']; ?></td>
                        <td><?php echo $dossier['statut']; ?></td>
                        <td><?php echo $dossier['annee_comptabilisation']; ?></td>
                        <td><?php echo $dossier['date_convocation']; ?></td>
                        <td><?php echo $dossier['date_devis']; ?></td>
                        <td><?php echo $dossier['date_debut_formation']; ?></td>
                        <td><?php echo $dossier['date_fin_formation']; ?></td>
                        <td><?php echo $dossier['date_envoi_evaluation']; ?></td>
                        <td><?php echo $dossier['date_evaluation']; ?></td>
                         <td>
                            <a href="index.php?page=viewDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>">Voir</a> |
                            <a href="index.php?page=viewLocalDrive&id=<?php echo $dossier['id_formation_dossiers']; ?>">Docs</a> |
                            <a href="index.php?page=editDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>">Éditer</a> |
                            <a href="index.php?page=deleteDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce dossier?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Bouton Supprimer -->
            <button type="submit" name="action" value="delete">Supprimer les dossiers sélectionnés</button>
            <!-- Menu déroulant pour le statut, généré dynamiquement -->
            <?php 
//var_dump($statuses); // Affiche le contenu de $statuses pour le débogage
if (is_string($statuses) && strpos(trim($statuses), '<select') !== 0) {
    echo "Échec du chargement du menu des statuts : " . $statuses;
} else {
    echo $statuses; // Affiche le menu déroulant
}
            ?>            
            <button type="submit" name="action" value="updateStatus">Modifier le statut</button>

        </form>
    </div>
</div>
 
<!-- Inclure le fichier JavaScript -->
<script src="assets/js/dossiers.js"></script>
