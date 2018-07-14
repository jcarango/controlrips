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
  if ($_SESSION['auditoria']==1)
  {
    require_once "../modelos/Consultas.php";
    $consulta = new Consultas();
    //Total cuentas medicas
    $rspta_cuentasmedicas = $consulta -> totalcuentasmedicas();
    $reg_cuentasmedicas = $rspta_cuentasmedicas -> fetch_object();
    $tota_cuentasmedicas = $reg_cuentasmedicas -> totalctasmedicas;
    //Total revision
    $rspta_revision = $consulta -> totalrevision();
    $reg_revision = $rspta_revision -> fetch_object();
    $tota_revision = $reg_revision -> total_revision;
    //total glosada
    $rspta_glosada = $consulta -> totalglosada();
    $reg_glosada = $rspta_glosada -> fetch_object();
    $tota_glosada = $reg_glosada -> total_glosada;
    //total obejtada
    $rspta_objetada = $consulta -> totalobjetada();
    $reg_objetada = $rspta_objetada -> fetch_object();
    $tota_objetada = $reg_objetada -> total_objetada;
    //Total finalizadas
    $rspta_finalizadas = $consulta -> totalfinalizadas();
    $reg_finalizadas = $rspta_finalizadas -> fetch_object();
    $tota_finalizadas = $reg_finalizadas -> totalfin;
    //Total usuarios - Listado
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Auditoría General
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Auditoria General</a></li>
        <li><a href="escritorio.php">Inicio</a></li>
        <li class="active">Auditoría</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Auditoría general</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
      </br>
        <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Cuentas Médicas</h3>
              <h5 class="widget-user-desc">Estados</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Todas <span class="pull-right badge bg-yellow"><?php echo $tota_cuentasmedicas; ?></span></a></li>
                <li><a href="#">Revisión <span class="pull-right badge bg-aqua"><?php echo $tota_revision; ?></span></a></li>
                <li><a href="#">Glosada <span class="pull-right badge bg-red"><?php echo $tota_glosada; ?></span></a></li>
                <li><a href="#">Objetada <span class="pull-right badge bg-red"><?php echo $tota_objetada; ?></span></a></li>
                <li><a href="#">Finalizada <span class="pull-right badge bg-blue"><?php echo $tota_finalizadas; ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Usuarios</h3>
              <h5 class="widget-user-desc">Estados</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <?php
                  $rspta_listado = $consulta->totalusuarios();
                  while ($reg_listado=$rspta_listado->fetch_object()){
                    echo "<li>".$reg_listado->usuario."<span class='pull-right badge bg-blue'>".$reg_listado->totales."</span></a></li>";
                  }
                ?>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

        
        
      </div>
      <!-- /.row -->



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