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
if ($_SESSION['salidas']==1)
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
                          <h1 class="box-title"> Informe Archivo de transacciones - AF: Por rango de fechas</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <form method="post" name="buscar" action="informeAF.php">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Inicio</label>
                          <input type="date" class="form-control" id="fechainicio" name="fechainicio" value="<?php echo date('Y-m-')."01"?>">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Fin</label>
                          <input type="date" class="form-control"  id="fechafin" name="fechafin" value="<?php echo date('Y-m-')."30"?>">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <input type="button" class="btn btn-block btn-success" id="Buscar" name="Buscar" value="Buscar">
                        </div>
                      </form>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Cod Prestador</th>
                            <th>Razón Social</th>
                            <th>Identificación</th>
                            <th>Factura</th>
                            <th>Fecha Expedición</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Cod Entidad Admin</th>
                            <th>Nom Entidad Admin</th>
                            <th>Número</th>
                            <th>Plan Beneficios</th>
                            <th>Póliza</th>
                            <th>Valor Copago</th>
                            <th>Valor Comision</th>
                            <th>Valor Desc</th>
                            <th>Valor Neto</th>
                            <th>Fecha Radicado</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>ID</th>
                            <th>Cod Prestador</th>
                            <th>Razón Social</th>
                            <th>Identificacion</th>
                            <th>Factura</th>
                            <th>Fecha Expedición</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Cod Entidad Admin</th>
                            <th>Nom Entidad Admin</th>
                            <th>Número</th>
                            <th>Plan Beneficios</th>
                            <th>Póliza</th>
                            <th>Valor Copago</th>
                            <th>Valor Comision</th>
                            <th>Valor Desc</th>
                            <th>Valor Neto</th>
                            <th>Fecha Radicado</th>
                          </tfoot>
                        </table>
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

<script type="text/javascript" src="scripts/contabilidad.js"></script>
<script type="text/javascript">

    $("#Buscar").click(function() {
          tabla=$('#tbllistado').dataTable(
          {
            "aProcessing": true,//Activamos el procesamiento del datatables
              "aServerSide": true,//Paginación y filtrado realizados por el servidor
              dom: 'Bfrtip',//Definimos los elementos del control de tabla
              buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                    ],
            "ajax":
                {
                  url: '../ajax/contabilidad.php?op=buscar&fechainicio='+$("#fechainicio").val()+'&fechafin='+$("#fechafin").val(),
                  type : "get",
                  dataType : "json",
                  error: function(e){
                    console.log(e.responseText);
                  }
                },
            "bDestroy": true,
            "iDisplayLength": 10,//Paginación
              "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
          }).DataTable();
    });
</script>
<?php
}
ob_end_flush();
?>
