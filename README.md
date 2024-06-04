Here is a summary of the main components of the "extranet" web application and their interaction, including information about the SQL structure:

1. Configuration (config.php)
Purpose: Configures the essential settings of the application, including database connection details.
2. Entry Point (index.php)
Purpose: Serves as the main entry point for the application, routing requests based on the page and action parameters in the URL.
3. Controllers (controllers.php)
Purpose: Handle user requests, interact with models, and render views.
Main controllers:
   - HomeController: Manages actions related to the homepage.
   - EntityController: Manages actions related to entities such as dossiers.
   - MenuStatutFormationController: Manages actions related to training statuses.
4. Models (models.php)
Purpose: Define the classes that interact with the database and represent different entities.
5. Views (views.php)
Purpose: Render HTML views for the application.
6. Views Directory (views/)
Purpose: Contains HTML templates for different parts of the application.
Examples of files:
   - dossiers.php: Template for displaying dossiers.
   - view_dossier.php: Template for displaying dossier details.
   - edit_dossier.php: Template for editing a dossier.
