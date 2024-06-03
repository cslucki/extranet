<!-- new_dossier.php -->
<div class="container">
    <h2>Saisie d'un nouveau dossier</h2>
        <form action="index.php?page=storeDossier" method="POST">
            <input type="hidden" name="id_guid" value="<?php echo htmlspecialchars($user_id); ?>">
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
</div>
