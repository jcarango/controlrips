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
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title"> Consolidado</h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <form method="post" name="buscar" action="cuentasmedicas.php">
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Número Factura</label>
                      <input type="text" class="form-control" id="numfactura" name="numfactura" value="">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Identificación</label>
                      <input type="text" class="form-control"  id="numiden" name="numiden" value="">
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <input type="button" class="btn btn-block btn-success" id="Buscar" name="Buscar" value="Buscar">
                    </div>
                  </form>
                </div>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/consolidado.js"></script>

<?php
}
ob_end_flush();
?>
