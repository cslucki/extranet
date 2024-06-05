<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
<div class="sb-sidenav-menu">
    <div class="nav">
        <!-- Gestion -->
        <div class="sb-sidenav-menu-heading">Gestion</div>
            <a class="nav-link" href="/index.php?page=dossiers">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Gestion dossiers
            </a>
            <a class="nav-link" href="/index.php?page=showLogin">
                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                Nouveau dossier
            </a>
                         


        <!-- Candidats -->
        <div class="sb-sidenav-menu-heading">Bénéficiaires</div>
        <a class="nav-link" href="/index.php?page=formationQuestionnaire">
            <div class="sb-nav-link-icon"><i class="fas fa-commenting"></i></div>
            Entretiens préalables
        </a>
        <?php
        /*
        <a class="nav-link" href="/index.php?page=listComments">
            <div class="sb-nav-link-icon"><i class="fas fa-commenting"></i></div>
            Commentaires
        </a>
        

        <a class="nav-link" href="/under_construction.html">
            <div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div>
            Devis et conventions
        </a>
        <a class="nav-link" href="/under_construction.html">
            <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
            Factures
        </a>
        <a class="nav-link" href="/under_construction.html">
            <div class="sb-nav-link-icon"><i class="fas fa-pencil-square"></i></div>
            Conventions
        </a>
        <a class="nav-link" href="/under_construction.html">
            <div class="sb-nav-link-icon"><i class="fas fa-file-text"></i></div>
            Évaluations à froid 
        </a>

<!-- Candidats -->
    <div class="sb-sidenav-menu-heading">Candidats</div>
        <a class="nav-link" href="/under_construction.html">
            <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
            Devis
        </a>
        <a class="nav-link" href="/under_construction.html">
            <div class="sb-nav-link-icon"><i class="fas fa-link"></i></div>
            Factures
        </a>
*/
?>
<!-- Gestion -->
<div class="sb-sidenav-menu-heading">Outils</div>
        <!-- Menu Statut de formation -->
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
            Statut de Formation
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="/index.php?page=menuStatutFormation">Liste</a>
                <a class="nav-link" href="/index.php?page=menuStatutFormation&action=add">Créer</a>
            </nav>
        </div>
        <!-- Menu Catalogue -->
        <a class="nav-link collapsed" href="/index.php?page=menuStatutFormation" data-bs-toggle="collapse" data-bs-target="#collapseFormation_Catalogue" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
            Catalogue
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseFormation_Catalogue" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="/index.php?page=menuFormation_Catalogue">Liste</a>
                <a class="nav-link" href="/index.php?page=menuFormation_Catalogue&action=add">Créer</a>
            </nav>
        </div>     

    </div>
</div>


<div class="sb-sidenav-footer">
    <div class="small">Connecté en tant que :</div>
    Cyril SLUCKI - Directeur