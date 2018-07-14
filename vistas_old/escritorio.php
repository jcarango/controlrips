<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
  {
    header("Location: login.html");
  }
else
  {
  require 'header.php';
  if ($_SESSION['escritorio']==1)
  {
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestion RIPS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Gestión RIPS</a></li>
        <li><a href="escritorio.php">Inicio</a></li>
        <li class="active">Escritorio</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ingreso - Informes - Consultas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <!-- /.box-header -->
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>RIPS</h3>

                    <p>Ingresar RIPS</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                  </div>
                  <a href="ingreso.php" class="small-box-footer">
                    Ingresar <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Facturas</h3>

                    <p>Buscar Facturas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file-alt"></i>
                  </div>
                  <a href="buscarfactura.php" class="small-box-footer">
                    Consultar <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Zeus</h3>

                    <p>Bajar Informe</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file-excel"></i>
                  </div>
                  <a href="contabilidad.php" class="small-box-footer">
                    Bajar <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>Cuentas</h3>

                    <p>Cuentas Médicas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-donate"></i>
                  </div>
                  <a href="cuentasmedicas.php" class="small-box-footer">
                    Cuentas Médicas <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>Archivos</h3>

                    <p>Descargar Archivos</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-download"></i>
                  </div>
                  <a href="archivos.php" class="small-box-footer">
                    Bajar <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Auditoría</h3>

                    <p>Cambio de estados</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file-alt"></i>
                  </div>
                  <a href="cambioestado.php" class="small-box-footer">
                    Cambiar <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
                </div>
              </div> <!-- /.col -->
            </div>
          </div>
    </section>
  </div>
<!-- /.content-wrapper -->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<?php 
}
ob_end_flush();
?> 