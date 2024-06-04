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
        
        <!-- Navbar inclusion -->  
        <?php include $_SERVER['DOCUMENT_ROOT'].'/views/partials/navbar.php'; ?>
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
                