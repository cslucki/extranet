<form action="index.php?page=storeDossier" method="POST">
    <div class="form-group">
        <label for="date_devis">Date du Devis:</label>
        <input type="date" class="form-control" name="date_devis" required>
    </div>
    <div class="form-group">
        <label for="id_formation_catalogue">Formation:</label>
        <select class="form-control" name="id_formation_catalogue">
            <?php foreach ($formations as $formation): ?>
                <option value="<?php echo $formation['id_formation_catalogue']; ?>">
                    <?php echo htmlspecialchars($formation['numero'] . ' - ' . $formation['titre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Créer Dossier</button>
</form>
