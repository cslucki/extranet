<?php if (!isset($page_title)) $page_title = "Default Title"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Extranet</title>
        <link href="/assets/css/style.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="/assets/js/datatables-simple-demo.js"></script>
          <!-- Include simple-datatables CSS -->
    
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/index.php"><b>Association AMT</b></a>
            <!-- Sidebar Toggle-->
            <button class="btn   order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
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
            <div class="d-none d-md-inline-block  ms-auto me-0 me-md-3 my-2 my-md-0">
          <?php include $_SERVER['DOCUMENT_ROOT'].'/views/partials/navbar.php'; ?>
            </div>
        </nav>
        
		
		<!-- Sidebar-->
		<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                    <?php include $_SERVER['DOCUMENT_ROOT'].'/views/partials/sidebar.php'; ?>
        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <!-- Page Content-->
            <main>
                    <?php
                    /*
                    <div class="container-fluid px-4">
                        <!--h1 class="mt-4"><?php echo $page_title; ?></-h1-->
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/index.php?page=home">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                        </ol>
                    </div>
                    */
                    ?>
                </main>
                