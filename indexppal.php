<!DOCTYPE html>
<html lang="en">

<head>
<?php

/* $Id:       index.php 2024/05/01 $*/
/* Author:    MAMS                  $*/
/* $Revision: 2024-1.0             $*/

$PageSecurity = 1;

include('includes/librerias.php');
include('includes/session.inc');
$title = 'Menu Principal';

$ModuleLink = array();
$ModuleList = array();
$ModuleIcon = array();
$I   = 0;
$sql = "Select * From accesos_modulos 
         Where idmodulo In(Select idmodulo From accesos_modulos_usuarios 
                            Where usuario = '".$_SESSION['UserID']."')
         Order By idmodulo";
$res = DB_query($sql,$db);
while ($row = DB_fetch_array($res)) {
   $ModuleLink[$I] = $row['modulelink'];    
   $ModuleList[$I] = $row['descripcionmodulo'];
   $ModuleIcon[$I] = $row['icono'];
	$I++;
}

if (!isset($_GET['App'])) $_SESSION['Module'] = $ModuleLink[0];
else $_SESSION['Module'] = $_GET['App'];

?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark justify-content-end">
      <ul class="navbar-nav">
        <a href="indexppal.php">
          <img src="Images/home.jpg" alt="Inicio" class="brand-image img-circle elevation-3" style="opacity:.8">
        </a>
        <a href="help.php">
          <img src="Images/help.jpg" alt="Ayuda" class="brand-image img-circle elevation-3" style="opacity:.8">
        </a>
        <a href="Logout.php?'.SID.'" onclick="return confirm(\''.'Esta seguro de salir de SlicWeb?'.'\');">
          <img src="Images/exit.jpg" alt="Salir" class="brand-image img-circle elevation-3" style="opacity:.8">
        </a>
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary bg-white elevation-4">
      <a href="indexppal.php" class="brand-link">
        <img src="Images/logo.jpg" alt="Logo" 
             class="brand-image img-rounded elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark pl-2"> SOMEMMA </span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="Images/usuario.jpg" class="img-circle elevation-2" alt="Imagen usuario">
          </div>
          <div class="info">
            <?php
              echo '<a href="" class="d-block">'.$_SESSION['UsersRealName'].'</a>';
            ?>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
              data-accordion="false">
            <li class="nav-header">M O D U L O S</li>
              <?php
                $i = 0;
                while ($i < count($ModuleLink)) {
                  echo '<li class="nav-item has-treeview">
                          <a href="'.$_SERVER['PHP_SELF'].'?App='.$ModuleLink[$i].'" class="nav-link">
                            <i class="nav-icon '.$ModuleIcon[$i].'"></i>
                            <p>'.$ModuleList[$i].'</p>
                          </a>';
                  echo '</li>';
                  $i++;
                }
              ?>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0 text-dark">Slic Soluciones</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="indexppal.php">Menu Principal</a></li>
                     <li class="breadcrumb-item active">Inicio</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.content-header -->

         <!-- Main content -->
         <section class="content">
         <div class="container">
         <?php
            if ($_GET['App']=='') {
               echo '<img class="img-fluid" src="'.$rootpath.'/companies/main_logo'.$_SESSION['DatabaseName'].'.jpg" class="rounded" alt="Fondo empresa">';
            } else {              
               echo '<div class="card-deck">
                        <div class="card">
                           <div class="card-header bg-primary">
                              <i class="pr-2 fas fa-industry"></i> Control Resúmenes
                           </div>
                           <div class="card-body">
                              <ul class="nav nav-pills flex-column">';                        
                                 $sql = "Select * From accesos_opciones 
                                          Where modulo = '".$_SESSION['Module']."' And opciontipo = 'T' 
                                            And software In(Select software 
                                                              From accesos 
                                                             Where userid = '".$_SESSION['UserID']."') 
                                           Order By software";
                                 $res = DB_query($sql,$db);
                                 while ($row = DB_fetch_array($res)) {  
                                    if ($row['linkopcion']=='') $ref = '>';
                                    else 
                                       $ref = 'href="'.$rootpath.'/'.$row['linkopcion'].(strpos($row['linkopcion'],'?')!==false?'&':'?').'App='.$_SESSION['Module'].'">';
                                    $link = '<li class="nav-item"> <a class="nav-link" '.$ref;
                                    for ($i = 1; $i <= $row['bullet']; $i++) $link .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
                                    $link .= $row['descripcion'];
                                    if ($row['linkopcion']=='') $link .= '</a>';
                                    else $link .= '</a>';
                                    echo $link;
                                 } 
                              echo '</ul>';  
                           echo '</div>';
                        echo '</div>';

                        echo '<div class="card">
                           <div class="card-header bg-primary">
                              <i class="pr-2 fas fa-chart-line"></i> Consultas y Reportes
                           </div>
                           <div class="card-body">
                              <ul class="nav nav-pills flex-column">';                        
                                 $sql = "Select * From accesos_opciones 
                                          Where modulo = '".$_SESSION['Module']."' And opciontipo = 'C' 
                                            And software In(Select software 
                                                              From accesos 
                                                             Where userid = '".$_SESSION['UserID']."') 
                                          Order By software";
                                 $res = DB_query($sql,$db);
                                 while ($row = DB_fetch_array($res)) {  
                                    if ($row['linkopcion']=='') $ref = '>';
                                    else 
                                       $ref = 'href="'.$rootpath.'/'.$row['linkopcion'].(strpos($row['linkopcion'],'?')!==false?'&':'?').'App='.$_SESSION['Module'].'">';
                                    $link = '<li class="nav-item"> <a class="nav-link" '.$ref;
                                    for ($i = 1; $i <= $row['bullet']; $i++) $link .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
                                    $link .= $row['descripcion'];
                                    if ($row['linkopcion']=='') $link .= '</a>';
                                    else $link .= '</a>';
                                    echo $link;
                                 } 
                              echo '</ul>';  
                           echo '</div>';
                        echo '</div>';

                        echo '<div class="card">
                           <div class="card-header bg-primary">
                              <i class="pr-2 far fa-address-book"></i> Catalogos y Mantenimientos
                           </div>
                           <div class="card-body">
                              <ul class="nav nav-pills flex-column">';                        
                                 $sql = "Select * From accesos_opciones 
                                          Where modulo = '".$_SESSION['Module']."' And opciontipo = 'M' 
                                            And software In(Select software 
                                                              From accesos 
                                                             Where userid = '".$_SESSION['UserID']."') 
                                          Order By software";
                                 $res = DB_query($sql,$db);
                                 while ($row = DB_fetch_array($res)) {  
                                    if ($row['linkopcion']=='') $ref = '>';
                                    else 
                                       $ref = 'href="'.$rootpath.'/'.$row['linkopcion'].(strpos($row['linkopcion'],'?')!==false?'&':'?').'App='.$_SESSION['Module'].'">';
                                    $link = '<li class="nav-item"> <a class="nav-link" '.$ref;
                                    for ($i = 1; $i <= $row['bullet']; $i++) $link .= "&nbsp;&nbsp;&nbsp;&nbsp;"; 
                                    $link .= $row['descripcion'];
                                    if ($row['linkopcion']=='') $link .= '</a>';
                                    else $link .= '</a>';
                                    echo $link;
                                 } 
                              echo '</ul>';  
                           echo '</div>';
                        echo '</div>';
                     echo '</div>';
            }
         ?> 
      </div>
   </section>
</body>

<footer class="page-footer font-small blue">
  <div class="footer-copyright text-center py-3">
    <strong>Copyright &copy; 1996-2024 <a href="http://Slic-Soluciones.com">Slic-Soluciones</a>.</strong>
    All rights reserved.
    <div class="d-none d-sm-inline-block">
      <b>Version</b> 2.0.0
    </div>       
  </div>
</footer>

<?php
  include('includes/libfooter.php');
?>
</html>
