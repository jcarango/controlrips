<?php
if (strlen(session_id()) < 1)
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RIPS | Adamm Soluciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- Ionicons -->
    <link rel="stylesheet" href="../public/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <!--Subir archivos-->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="scripts/script.js"></script>

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>R</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Ctr-RIPS</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                      <img src="../files/img/logo.png" alt="logo">
                      <br>Usuario: <?php echo $_SESSION['login']; ?>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php
            if ($_SESSION['escritorio']==1)
            {
              echo '<li>
              <a href="escritorio.php"><i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['ingresos']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Ingresos RIPS</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingreso RIPS</a></li>
                <li><a href="buscarfactura.php"><i class="fa fa-circle-o"></i> Buscar Facturas</a></li>
                <li><a href="cuadredia.php"><i class="fa fa-circle-o"></i> Cuadre</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['salidas']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Descargas/Proceso</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	<li><a href="cuentasmedicas.php"><i class="fa fa-circle-o"></i> Cuentas Médicas</a></li>
               <li><a href="contabilidad.php"><i class="fa fa-circle-o"></i> Descarga Zeus</a></li>
               <li><a href="archivos.php"><i class="fa fa-circle-o"></i> Descargar Archivos</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['informes']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fas fa-file-pdf"></i><span> Informes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="consolidadocuentasmedicas.php"><i class="fa fa-circle-o"></i> Descarga Cuentas Médicas</a></li>
                <li><a href="informeCT.php"><i class="fa fa-circle-o"></i> Archivo de control - CT</a></li>
                <li><a href="informeAF.php"><i class="fa fa-circle-o"></i> Archivo de transacciones - AF</a></li>
                <li><a href="informeUS.php"><i class="fa fa-circle-o"></i> Archivo de usuarios - US</a></li>
                <li><a href="informeAC.php"><i class="fa fa-circle-o"></i> Archivo de consulta - AC</a></li>
                <li><a href="informeAP.php"><i class="fa fa-circle-o"></i> Archivo de procedimientos - AP</a></li>
                <li><a href="informeAU.php"><i class="fa fa-circle-o"></i> Archivo de urgencia - AU</a></li>
                <li><a href="informeAH.php"><i class="fa fa-circle-o"></i> Archivo de hospitalización - AH</a></li>
                <li><a href="informeAN.php"><i class="fa fa-circle-o"></i> Archivo de recién nacidos - AN</a></li>
                <li><a href="informeAM.php"><i class="fa fa-circle-o"></i> Archivo de medicamentos - AM</a></li>
                <li><a href="informeAT.php"><i class="fa fa-circle-o"></i> Archivo de otros servicios - AT</a></li>
                <li><a href="informeAD.php"><i class="fa fa-circle-o"></i> Archivo - AD</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['auditoria']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fas fa-universal-access"></i><span> Auditoría</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="auditoria.php"><i class="fa fa-circle-o"></i> Auditoría</a></li>
                <li><a href="consolidadocuentasmedicas.php"><i class="fa fa-circle-o"></i> Consolidado</a></li>
                <li><a href="cambioestado.php"><i class="fa fa-circle-o"></i> Cambiar Estados</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['informes']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fas fa-file-pdf"></i><span> Liquidaciones</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="informeliquidacionAF.php"><i class="fa fa-circle-o"></i> Archivo Liquidación - AF</a></li>
                <li><a href="informeliquidacionAC.php"><i class="fa fa-circle-o"></i> Archivo Liquidación - AC</a></li>
                <li><a href="informeliquidacionAP.php"><i class="fa fa-circle-o"></i> Archivo Liquidación - AP</a></li>
                <li><a href="informeliquidacionAM.php"><i class="fa fa-circle-o"></i> Archivo Liquidación - AM</a></li>
                <li><a href="informeliquidacionAT.php"><i class="fa fa-circle-o"></i> Archivo Liquidación - AT</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['acceso']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fas fa-universal-access"></i><span> Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
              </ul>
            </li>';
            }
            ?>

            <!--<li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>-->

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
