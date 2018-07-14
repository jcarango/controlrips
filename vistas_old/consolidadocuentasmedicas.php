<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
require_once "../modelos/Usuario.php";
$listado = new Usuario();

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
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Inicio</label>
                          <input type="date" class="form-control" id="fechainicio" name="fechainicio" value="<?php echo date('Y-m-')."01"?>">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Fecha Fin</label>
                          <input type="date" class="form-control"  id="fechafin" name="fechafin" value="<?php echo date('Y-m-')."30"?>">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Número Factura</label>
                          <input type="text" class="form-control" id="numfactura" name="numfactura" value="">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Identificación - NIT</label>
                          <input type="text" class="form-control"  id="numiden" name="numiden" value="">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Usuario:</label>
                          <select name="glosaus" id="glosaus" class="form-control">
                            <?php
                              $rspta = $listado->listar();
                              while ($reg=$rspta->fetch_object()){
                                echo "<option value='".$reg->login."'>".$reg->nombre."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <input type="button" class="btn btn-block btn-success" id="Buscarresumen" name="Buscarresumen" value="Buscar">
                        </div>
                      </form>
                        </br>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
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
                      <div class="col-md-6">
                      <div class="box box-widget widget-user-2">
                        <div class="widget-user-header bg-yellow">
                          <h3 class="widget-user-username"><input type="text" id="totalfactu" name="totalfactu" value="0" style="color: #0c0c0c"></h3>
                          <h5 class="widget-user-desc">Total factura o Empresa</h5>
                        </div>
                      </div>
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

      $("#Buscarresumen").click(function() {
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
                    url: '../ajax/consolidadocuentasmedicas.php?op=buscar&fechainicio='+$("#fechainicio").val()+'&fechafin='+$("#fechafin").val()+'&factura='+$("#numfactura").val()+'&identificacion='+$("#numiden").val()+'&usuario='+$("#glosaus").val(),
                    type : "get",
                    dataType : "json",
                    error: function(e){
                      console.log(e.responseText);
                    },
                    complete: function(xhr,status) {
                      var myObj = JSON.parse(xhr.responseText);
                      //alert(myObj.iTotalFact);
                      $("#totalfactu").val(myObj.iTotalFact);
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
