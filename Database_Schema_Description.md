
## `formation_dossiers` Table Description
- `id_formation_dossiers`: Unique identifier for each training dossier entry, an integer type that auto-increments. This serves as a primary key.
- `participation_prealable`: An ENUM type indicating whether the respondent has previously participated in a similar training. Values are 'OUI' (YES) and 'NON' (NO).
- `date_debut_souhaitee`: An ENUM type specifying the desired start date for the training. Possible values are 'Dès que possible' (As soon as possible), 'Dans 15 jours' (In 15 days), and 'Dans 1 mois' (In 1 month).
- `attentes_formation`: A text type that contains the participant's expectations from the training.
- `competence1` to `competence6`: ENUM types for six skills, indicating the stage of acquisition: 'Acquise' (Acquired), 'En cours d'acquisition' (In process of acquisition), and 'À acquérir' (To be acquired).

## Relationships between tables
- `formation_dossiers` contains a column `id_formation_catalogue` which is a foreign key referencing `formation_catalogue.id_formation_catalogue`. This relationship links each training dossier to a specific training in the catalog, indicating which particular training the dossier details pertain to.
