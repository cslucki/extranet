# Table Structure

## formation_catalogue
- `id_formation_catalogue`: Unique identifier for the training
- `titre`: Title of the training
- `numero`: Reference number of the training
- `duree_synchrone`: Synchronous duration of the training in hours
- `duree_asynchrone`: Asynchronous duration of the training in hours
- `prix`: Price of the training
- `description`: Detailed description of the training
- `is_catalogue`: Indicates if the training is included in the catalog ('Y' or 'N')

## formation_dossiers
- `id_formation_dossiers`: Unique identifier for the training file
- `id_formation_catalogue`: Reference to the training identifier in the catalog
- `id_menustatutformation`: Reference to the training status identifier
- `id_guid`: Globally unique identifier
- `date_devis`: Date of the quote
- `date_devis_signe`: Date the quote was signed
- `date_pec`: Date of coverage
- `date_debut_formation`: Start date of the training
- `date_fin_formation`: End date of the training
- `date_cheque_caution_recu`: Date of receipt of the security deposit check
- `date_envoi_attestation`: Date the certificate was sent
- `moyen_paiement`: Payment method (CH for check, VIR for bank transfer)
- `attestation_recu`: Indicates if the certificate has been received ('Y' or 'N')
- `date_fond_recu_par_stagiaire`: Date the funds were received by the trainee
- `date_solde_dossier`: Date the file was settled
- `formation_collective`: Indicates if the training is collective ('Y' or 'N')
- `nbre_seances_faites`: Number of sessions completed
- `p10_brief_formation`: Indicates if the training brief has been done ('Y' or 'N')
- `p20_refaire_argu`: Indicates if the arguments need to be redone ('Y' or 'N')
- `p30_ae_en_crea`: Indicates if the AE is being created ('Y' or 'N')
- `p40_attestation_cfp_en_attente`: Indicates if the CFP certificate is pending ('Y' or 'N')
- `p50_attente_pec`: Indicates if the coverage is pending ('Y' or 'N')
- `p60_pec_ok`: Indicates if the coverage is okay ('Y' or 'N')
- `pec_numero`: Coverage number
- `f10_formation_en_cours`: Indicates if the training is ongoing ('Y' or 'N')
- `f20_formation_finie`: Indicates if the training is finished ('Y' or 'N')

## `formation_questionnaire_avant` 
- `id_formation_dossiers`: Unique identifier for each training dossier entry, an integer type that auto-increments. This serves as a primary key.
- `participation_prealable`: An ENUM type indicating whether the respondent has previously participated in a similar training. Values are 'OUI' (YES) and 'NON' (NO).
- `date_debut_souhaitee`: An ENUM type specifying the desired start date for the training. Possible values are 'Dès que possible' (As soon as possible), 'Dans 15 jours' (In 15 days), and 'Dans 1 mois' (In 1 month).
- `attentes_formation`: A text type that contains the participant's expectations from the training.
- `competence1` to `competence6`: ENUM types for six skills, indicating the stage of acquisition: 'Acquise' (Acquired), 'En cours d'acquisition' (In process of acquisition), and 'À acquérir' (To be acquired).

## menustatutformation
- `id`: Unique identifier for the training status
- `text`: Textual description of the training status

## user
- `nom_domaine`: Domain associated with the user (default 'media.com')
- `id_guid`: Globally unique identifier for each user
- `login`: User's login identifier
- `date`: Date and time associated with the user
- `password`: User's password (hashed)

## user_coordonnee
This table contains contact information and other personal information of users.
- `nom_domaine`: Domain associated with the user
- `id_guid`: Globally unique identifier for each user
- `civilites`: User's salutation (M for Mister, MME for Madam)
- `societe`: User's company name
- `nom`: User's last name
- `prenom`: User's first name
- `adresse`: User's address
- `code_postal`: User's postal code
- `ville`: User's city
- `pays`: User's country identifier
- `telephone`: User's phone number
- `fax`: User's fax number
- `mobile`: User's mobile number
- `email`: User's email address
- `web`: User's website
- `compte_workspace`: User's workspace account
- `compte_workspace_pass`: User's workspace account password
- `statut_cw`: User's CW status
- `identifiant`: User's identifier
- `legal_form`: User's legal form
- `code_ape`: User's APE code
- `is_crea`: User's creation indicator
- `ca_cw`: User's CW turnover
- `ca_futur_cw`: User's future CW turnover
- `date_naissance`: User's date of birth
- `date_creation`: User's creation date
- `portage`: User's portage information
- `tva`: User's VAT number
- `is_tva`: User's VAT indicator ('Y' for yes, 'N' for no)
- `msn`: User's MSN
- `skype`: User's Skype



## lm_gestion_lm_comments
- `id`: Unique identifier for the comment
- `id_guid_from`: Identifier of the user who made the comment
- `id_guid_to`: Identifier of the user or entity the comment is addressed to
- `comments`: The content of the comment
- `only_admin`: Indicates if the comment is visible only to admins (`Y` for yes, `N` for no)
- `date`: The date and time when the comment was made
- `id_emailing`: Identifier for the related emailing, if any
- `date_relance`: The follow-up date and time, if any
- `type`: The type of comment
- `nbre_ticket`: Number of related tickets, if any



## Relationships between tables

- `formation_dossiers` contains a column `id_formation_catalogue` which is a foreign key referencing `formation_catalogue.id_formation_catalogue`.
- `formation_dossiers` contains a column `id_menustatutformation` which is a foreign key referencing `menustatutformation.id`.
- `formation_dossiers` contains a column `id_guid` which is a foreign key referencing `user.id_guid`.
- `formation_dossiers` contains a column `id_guid` which is a foreign key referencing `user_coordonnee.id_guid`.
- `formation_questionnaire_avant` contains a column `id_formation_dossier` which is a foreign key referencing `formation_dossiers.id_formation_dossier`. This relationship links each pre-training questionnaire to a specific training dossier, indicating which particular training the questionnaire details pertain to.
- `lm_gestion_lm_comments` contains a column `id_guid_to` which is a foreign key referencing `formation_dossiers.id_guid`. This relationship links each comments to a specific training dossier, indicating which particular training the comments details pertain to.
