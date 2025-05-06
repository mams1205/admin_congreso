<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>

<header id = "header">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav style="background-color: white;" class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="default.php" class="navbar-brand p-0">
                <!-- <h1 class="text-primary"><i class="fas fa-hand-holding-water me-3"></i></h1> -->
                <img src="img/logo.png" alt="Logo">
                <img src="img/logo_solamac.png" alt="Logo">
            </a>
            <div id="google_translate_element"></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="default.php" class="nav-item nav-link <?= ($currentPage == 'default.php') ? 'active' : '' ?>">Home</a>
                    <a href="Registro.php" class="nav-item nav-link <?= ($currentPage == 'Registro.php') ? 'active' : '' ?>">Registro</a>
                    <a href="mztln.php" class="nav-item nav-link <?= ($currentPage == 'mztln.php') ? 'active' : '' ?>">Mazatlán</a>
                </div>
                <a href="inscripcion.php" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Pago de Inscripción</a>
            </div>
               
        </nav>
        <!-- Header End -->
    </div>
    
    <!-- Navbar & Hero End -->
</header>