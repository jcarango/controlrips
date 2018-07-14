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
if ($_SESSION['ingresos']==1)
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
                          <h1 class="box-title"> Consultar Facturas Ingresadas</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Eliminación</th>
                            <th>ID</th>
                            <th>Razón Social</th>
                            <th>Número de Identificación</th>
                            <th>Número de Factura</th>
                            <th>Valor Neto</th>
                            <th>Fecha Radicado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Eliminación</th>
                            <th>ID</th>
                            <th>Razón Social</th>
                            <th>Número de Identificación</th>
                            <th>Número de Factura</th>
                            <th>Valor Neto</th>
                            <th>Fecha Radicado</th>
                          </tfoot>
                        </table>
                    </div> <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <input type="hidden" name="idAF" id="idAF">
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
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
<script type="text/javascript" src="scripts/buscarfactura.js"></script>
<?php 
}
ob_end_flush();
?>