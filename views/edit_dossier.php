<div class="card">
    <div class="card-header">
        Éditer le Dossier de Formation
    </div>
    <div class="card-body">
        <form action="index.php?page=updateDossier&id=<?php echo $dossier['id_formation_dossiers']; ?>" method="POST">
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <p class="form-control-static"><?php echo $dossier['prenom']; ?></p>
            </div>
            <div class="form-group">
                <label for="nom">Nom:</label>
                <p class="form-control-static"><?php echo $dossier['nom']; ?></p>
            </div>
            <div class="form-group">
                <label for="formation">Formation actuelle:</label>
                <p class="form-control-static"><?php echo $dossier['numero'] . ' - ' . $dossier['titre']; ?></p>
            </div>
            <div class="form-group">
                <label for="id_formation_catalogue">Nouvelle Formation:</label>
                <select class="form-control" name="id_formation_catalogue">
                    <?php foreach ($formations as $formation) : ?>
                        <option value="<?php echo $formation['id_formation_catalogue']; ?>" <?php echo ($formation['id_formation_catalogue'] == $dossier['id_formation_catalogue']) ? 'selected' : ''; ?>>
                            <?php echo $formation['numero'] . ' - ' . $formation['titre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date_debut_formation">Date de début:</label>
                <input type="date" class="form-control" name="date_debut_formation" value="<?php echo $dossier['date_debut_formation']; ?>" required>
            </div>
            <div class="form-group">
                <label for="date_fin_formation">Date de fin:</label>
                <input type="date" class="form-control" name="date_fin_formation" value="<?php echo $dossier['date_fin_formation']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>