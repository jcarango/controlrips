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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"> Consolidado Cuentas Médicas</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <form method="post" name="buscar" action="consolidadocuentasmedicas.php">
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Número Factura</label>
                          <input type="text" class="form-control" id="numfactura" name="numfactura" value="">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Identificación</label>
                          <input type="text" class="form-control"  id="numiden" name="numiden" value="">
                        </div>
                        <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                          <input type="button" class="btn btn-block btn-success" id="Buscar" name="Buscar" value="Buscar">
                        </div>
                      </form>
                        </br>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Cod Prestador</th>
                            <th>Razón Social</th>
                            <th>Identificación</th>
                            <th>Factura</th>
                            <th>Expedición Factura</th>
                            <th>Inicio Factura</th>
                            <th>Final Factura</th>
                            <th>Cod Admin</th>
                            <th>Nombre Admin</th>
                            <th>Número Contacto</th>
                            <th>Plan Beneficios</th>
                            <th>Póliza</th>
                            <th>Valor Copago</th>
                            <th>Valor Comisión</th>
                            <th>Valor Descuentos</th>
                            <th>Valor Neto</th>
                            <th>Radicado</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                            <th>Estado</th>
                            <th>Estado Persistencia</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Cod Prestador</th>
                            <th>Razón Social</th>
                            <th>Identificación</th>
                            <th>Factura</th>
                            <th>Expedición Factura</th>
                            <th>Inicio Factura</th>
                            <th>Final Factura</th>
                            <th>Cod Admin</th>
                            <th>Nombre Admin</th>
                            <th>Número Contacto</th>
                            <th>Plan Beneficios</th>
                            <th>Póliza</th>
                            <th>Valor Copago</th>
                            <th>Valor Comisión</th>
                            <th>Valor Descuentos</th>
                            <th>Valor Neto</th>
                            <th>Radicado</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                            <th>Estado</th>
                            <th>Estado Persistencia</th>
                          </tfoot>
                        </table>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="panel-body table-responsive" id="dvusuarios" hidden="hidden">
                        <h4 class="modal-title">Usuarios</h4>
                          <table id="tbllistadousuarios" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                              <th>ID</th>
                              <th>Tipo Identf</th>
                              <th>Identificación</th>
                              <th>codigoentidadadministradora</th>
                              <th>tipousuario</th>
                              <th>primerapellido</th>
                              <th>segundoapellido</th>
                              <th>primernombre</th>
                              <th>segundonombre</th>
                              <th>edad</th>
                              <th>unidadmedidadedad</th>
                              <th>sexo</th>
                              <th>codigodepartamento</th>
                              <th>codigomunicipio</th>
                              <th>zonaresidencia</th>
                              <th>estado</th>
                              <th>Glosa</th>
                              <th>Valor Glosa</th>
                              <th>Devolución</th>
                              <th>Nota Crédito</th>
                              <th>Observaciones</th>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.modal -->
                        <div class="panel-body table-responsive" id="dvconsulta" hidden="hidden">
                          <h4 class="modal-title">Consulta</h4>
                        <table id="tbllistadoconsulta" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Factura</th>
                            <th>Prestador</th>
                            <th>Tipo Identf</th>
                            <th>Identificación</th>
                            <th>Fecha</th>
                            <th>Autorización</th>
                            <th>Código</th>
                            <th>Finalidad</th>
                            <th>Causa Externa</th>
                            <th>Diagnostico principal</th>
                            <th>Diagnóstico relacionado 1</th>
                            <th>Diagnóstico relacionado 2</th>
                            <th>Diagnóstico relacionado 3</th>
                            <th>Tipo Diagnostico Principal</th>
                            <th>Valor consulta</th>
                            <th>Valor copago</th>
                            <th>Valor Neto</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <div class="panel-body table-responsive" id="dvprocedimiento" hidden="hidden">
                        <h4 class="modal-title">Procedimientos</h4>
                        <table id="tbllistadoprocedimiento" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Factura</th>
                            <th>codigoprestadorserviciossalud</th>
                            <th>Tipo Identf</th>
                            <th>Identificación</th>
                            <th>Fecha</th>
                            <th>Autorización</th>
                            <th>Código</th>
                            <th>Finalidad</th>
                            <th>Ambito</th>
                            <th>personalqueatiende</th>
                            <th>Diagnostico principal</th>
                            <th>Diagnóstico relacionado</th>
                            <th>complicacion</th>
                            <th>formarealizacionactoquirurgico</th>
                            <th>valorprocedimiento</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <div class="panel-body table-responsive" id="dvurgencias" hidden="hidden">
                        <h4 class="modal-title">Urgencias</h4>
                        <table id="tbllistadourgencias" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Factura</th>
                            <th>codigoprestadorserviciossalud</th>
                            <th>Tipo Identf</th>
                            <th>Identificación</th>
                            <th>Fecha</th>
                            <th>horaingreso</th>
                            <th>numeroautorizacion</th>
                            <th>causaexterna</th>
                            <th>diagnosticosalida</th>
                            <th>diagnosticorelacionadosalida1</th>
                            <th>diagnosticorelacionadosalida2</th>
                            <th>diagnosticorelacionadosalida3</th>
                            <th>destinousuariosalidaobservacion</th>
                            <th>estadosalida</th>
                            <th>causabasicamuerteurgencias</th>
                            <th>fechasalidaobservacion</th>
                            <th>horasalidaobservacion</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <div class="panel-body table-responsive" id="dvhospitalizacion" hidden="hidden">
                        <h4 class="modal-title">Hospitalizacion</h4>
                        <table id="tbllistadohospitalizacion" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>ID</th>
                          <th>Estado</th>
                          <th>Factura</th>
                          <th>codigoprestadorserviciossalud</th>
                          <th>Tipo Identf</th>
                          <th>Identificación</th>
                          <th>viaingresoinstitución</th>
                          <th>fechaingreso</th>
                          <th>horaingreso</th>
                          <th>numeroautorizacion</th>
                          <th>causaexterna</th>
                          <th>diagnosticoprincipalingreso</th>
                          <th>diagnosticoprincipalegreso</th>
                          <th>diagnosticorelacionadoegreso1</th>
                          <th>diagnosticorelacionadoegreso2</th>
                          <th>diagnosticorelacionadoegreso3</th>
                          <th>estadosalida</th>
                          <th>diagnosticocausabasicamuerte</th>
                          <th>fechaegreso</th>
                          <th>horaegreso</th>
                          <th>Glosa</th>
                          <th>Valor Glosa</th>
                          <th>Devolución</th>
                          <th>Nota Crédito</th>
                          <th>Observaciones</th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                    <div class="panel-body table-responsive" id="dvnacidos" hidden="hidden">
                      <h4 class="modal-title">Nacidos</h4>
                      <table id="tbllistadonacidos" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>ID</th>
                          <th>Estado</th>
                          <th>Factura</th>
                          <th>codigoprestadorserviciossalud</th>
                          <th>Tipo Identf</th>
                          <th>Identificación</th>
                          <th>Fecha nacimiento</th>
                          <th>edadgestacional</th>
                          <th>controlprenatal</th>
                          <th>sexo</th>
                          <th>peso</th>
                          <th>diagnosticoreciennacido</th>
                          <th>causabasicamuerte</th>
                          <th>fechamuerte</th>
                          <th>hora</th>
                          <th>Glosa</th>
                          <th>Valor Glosa</th>
                          <th>Devolución</th>
                          <th>Nota Crédito</th>
                          <th>Observaciones</th>
                        </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <div class="panel-body table-responsive" id="dvmedicamentos" hidden="hidden">
                        <h4 class="modal-title">Medicamentos</h4>
                        <table id="tbllistadomedicamentos" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Factura</th>
                            <th>codigoprestadorserviciossalud</th>
                            <th>Tipo Identf</th>
                            <th>Identificación</th>
                            <th>numeroautorizacion</th>
                            <th>codigomedicamento</th>
                            <th>tipomedicamento</th>
                            <th>nombregenericomedicamento</th>
                            <th>formafarmaceutica</th>
                            <th>concentracionmedicamento</th>
                            <th>unidadmedidamedicamento</th>
                            <th>numerounidades</th>
                            <th>valorunitariomedicamento</th>
                            <th>valortotalmedicamento</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <div class="panel-body table-responsive" id="dvotros" hidden="hidden">
                        <h4 class="modal-title">Otros</h4>
                        <table id="tbllistadootros" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>ID</th>
                            <th>Factura</th>
                            <th>Cod Prestador</th>
                            <th>Identificación</th>
                            <th>Autorización</th>
                            <th>Tipo Servicio</th>
                            <th>Cod Servicio</th>
                            <th>Nombre Servicio</th>
                            <th>Cantidad</th>
                            <th>Valor Unitario</th>
                            <th>Valor Total</th>
                            <th>Glosa</th>
                            <th>Valor Glosa</th>
                            <th>Devolución</th>
                            <th>Nota Crédito</th>
                            <th>Observaciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                      <button class="btn btn-primary" type="submit" id="btnGuardarf"><i class="fa fa-save"></i> Guardar</button>
                      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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

<script type="text/javascript" src="scripts/consolidadocuentasmedicas.js"></script>

<script type="text/javascript">

    function selecact(idAC) {
        $("#idAC").val(idAC);
    }

    function selecpro(idAP) {
        $("#idAP").val(idAP);
    }

    function selecua(idAU) {
        $("#idAU").val(idAU);
    }

    function selecuh(idAH) {
        $("#idAH").val(idAH);
    }

    function selecun(idAN) {
        $("#idAN").val(idAN);
    }

    function selecum(idAM) {
        $("#idAM").val(idAM);
    }

    function selecum(idUS) {
        $("#idUS").val(idUS);
    }

    function selecat(idAT) {
        $("#idAT").val(idAT);
    }

    $("#mconsulta").click(function() {
          $("#dvconsulta").toggle();
          tabla=$('#tbllistadoconsulta').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAC&idAF='+$("#numerofactura").val(),
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

    $("#mprocedimientos").click(function() {
          $("#dvprocedimiento").toggle();
          tabla=$('#tbllistadoprocedimiento').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAP&idAF='+$("#numerofactura").val(),
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

    $("#murgencias").click(function() {
          $("#dvurgencias").toggle();
          tabla=$('#tbllistadourgencias').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAU&idAF='+$("#numerofactura").val(),
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

    $("#mhospitalizacion").click(function() {
          $("#dvhospitalizacion").toggle();
          tabla=$('#tbllistadohospitalizacion').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAH&idAF='+$("#numerofactura").val(),
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

    $("#mnacidos").click(function() {
          $("#dvnacidos").toggle();
          tabla=$('#tbllistadonacidos').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAN&idAF='+$("#numerofactura").val(),
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

    $("#mmedicamentos").click(function() {
          $("#dvmedicamentos").toggle();
          tabla=$('#tbllistadomedicamentos').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAM&idAF='+$("#numerofactura").val(),
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

    $("#musuarios").click(function() {
          $("#dvusuarios").toggle();
          tabla=$('#tbllistadousuarios').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarUS&idAF='+$("#numerofactura").val(),
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

    $("#motros").click(function() {
          $("#dvotros").toggle();
          tabla=$('#tbllistadootros').dataTable(
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
                  url: '../ajax/consolidadocuentasmedicas.php?op=buscarAT&idAF='+$("#numerofactura").val(),
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
                    url: '../ajax/consolidadocuentasmedicas.php?op=buscar&fechainicio='+'&factura='+$("#numfactura").val()+'&identificacion='+$("#numiden").val(),
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
