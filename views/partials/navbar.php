<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/index.php"><b>Association AMT</b></a>
    <!-- Sidebar Toggle-->
    <button class="btn order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <?php
    /*
    <form name="searchForm" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input name="searchQuery" class="form-control" type="text" placeholder="Rechercher..." aria-label="Rechercher..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    */
    ?>
    <!-- Navbar-->
    <div class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <!-- Ajout des boutons pour Gestion dossier et Nouveau dossier avec espacement -->
            <li class="nav-item me-2">
                <a class="nav-link btn btn-success" href="/index.php?page=showLogin">Nouveau dossier</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link btn btn-primary" href="/index.php?page=dossiers">Gestion dossiers</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link btn btn-secondary" href="//index.php?page=formationQuestionnaire">Qualité</a>
            </li>

        </ul>
    </div>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-tools fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/utils/summary_for_chatgpt.php">Genère README.MD</a></li>
                <li><a class="dropdown-item" href="/utils/contenu_fichiers.php">Genère SRC_PHP.md</a></li>
                <li><a class="dropdown-item" href="/utils/ImportExcel.php">Import XL</a></li>
                <li><a class="dropdown-item" href="/utils/DossiersUtil.php">Utilitaires Dossiers</a></li> 
                <li><a class="dropdown-item" href="utils/update_date_entretien.php">Update date_entretien</a></li> 
                <li><a class="dropdown-item" href="utils/update_date_convocation.php">Update date_convocation</a></li> 
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>