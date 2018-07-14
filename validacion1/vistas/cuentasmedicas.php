<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
require_once "../modelos/Cuentasmedicas.php";
$opciones = new Cuentasmedicas();

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
                          <h1 class="box-title"> Cuentas Médicas</h1>
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
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Fecha Inicio</label>
                          <input type="date" class="form-control" id="fechainicio" name="fechainicio" value="<?php echo date('Y-m-')."01"?>">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                          <label>Fecha Fin</label>
                          <input type="date" class="form-control"  id="fechafin" name="fechafin" value="<?php echo date('Y-m-')."30"?>">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                            <th>Estado</th>
                            <th>Estado Persistencia</th>
                          </tfoot>
                        </table>
                    </div>

                  <!-- Historial -->
                  <div class="panel-body table-responsive" id="listadoregistroshistorial">
                      <table id="tbllistadohistorial" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>ID</th>
                          <th>Accion</th>
                          <th>Factura</th>
                          <th>idAF</th>
                          <th>Fecha</th>
                          <th>Nueva glosa</th>
                          <th>Vieja glosa</th>
                          <th>Nuevo valor glosa</th>
                          <th>Viejo valor glosa</th>
                          <th>Nuevo devolución</th>
                          <th>Viejo devolución</th>
                          <th>Nuevo notacredito</th>
                          <th>Viejo notacredito</th>
                          <th>Nuevo observaciones</th>
                          <th>Viejo observaciones</th>
                          <th>Usuario</th>
                          <th>Nuevo estado</th>
                          <th>Viejo estado</th>
                          <th>Nuevo estadopersistencia</th>
                          <th>Viejo estadopersistencia</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>ID</th>
                          <th>Accion</th>
                          <th>Factura</th>
                          <th>idAF</th>
                          <th>Fecha</th>
                          <th>Nueva glosa</th>
                          <th>Vieja glosa</th>
                          <th>Nuevo valor glosa</th>
                          <th>Viejo valor glosa</th>
                          <th>Nuevo devolución</th>
                          <th>Viejo devolución</th>
                          <th>Nuevo notacredito</th>
                          <th>Viejo notacredito</th>
                          <th>Nuevo observaciones</th>
                          <th>Viejo observaciones</th>
                          <th>Usuario</th>
                          <th>Nuevo estado</th>
                          <th>Viejo estado</th>
                          <th>Nuevo estadopersistencia</th>
                          <th>Viejo estadopersistencia</th>
                        </tfoot>
                      </table>
                      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                  <!-- Historial -->

                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Factura:</label>
                            <input type="hidden" name="idAF" id="idAF">
                            <input type="text" class="form-control" name="numerofactura" id="numerofactura" disabled>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Prestador</label>
                            <input type="text" class="form-control" name="codprestadorservicio" id="codprestadorservicio" disabled>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Número Identificación</label>
                            <input type="text" class="form-control" name="numeroidentificacion" id="numeroidentificacion" disabled>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor Neto</label>
                            <input type="text" class="form-control" name="valorneto" id="valorneto" disabled>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Glosa:</label>
                            <select name="glosa" id="glosa" class="form-control">
                              <?php
                                $rspta = $opciones->glosas();
                                while ($reg=$rspta->fetch_object()){
                                      echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                }
                               ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor glosa:</label>
                            <input type="text" class="form-control" name="valorglosa" id="valorglosa" maxlength="20" placeholder="Valor glosa">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Devolución:</label>
                            <input type="text" class="form-control" name="devolucion" id="devolucion" maxlength="50" placeholder="Devolución">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Nota Crédito:</label>
                            <input type="text" class="form-control" name="notacredito" id="notacredito" maxlength="20" placeholder="Nota Crédito">
                          </div>
                          <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <label>Observaciones:</label>
                            <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="250" placeholder="Observaciones">
                          </div>
                          <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado:</label>
                            <input type="text" class="form-control" name="estado" id="estado" maxlength="250" disabled>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado Persistencia:</label>
                            <input type="text" class="form-control" name="estadopersistencia" id="estadopersistencia" maxlength="250" disabled>
                          </div>-->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                          <div class="row">
                            <div class="col-xs-12">
                              <div class="box box-default">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Cuentas Relacionadas</h3>
                                </div>
                                <div class="box-body">
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-usuarios" id="musuarios" name="musuarios">
                                    Usuarios
                                  </button>
                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-consulta" id="mconsulta" name="mconsulta">
                                    Consulta
                                  </button>
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-procedimientos" id="mprocedimientos" name="mprocedimientos">
                                    Procedimientos
                                  </button>
                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-urgencias" id="murgencias" name="murgencias">
                                    Urgencias
                                  </button>
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-hospitalizacion" id="mhospitalizacion" name="mhospitalizacion">
                                    Hospitalización
                                  </button>
                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-nacidos" id="mnacidos" name="mnacidos">
                                    Nacidos
                                  </button>
                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-medicamentos" id="mmedicamentos" name="mmedicamentos">
                                    Medicamentos
                                  </button>
                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-otros" id="motros" name="motros">
                                    Otros
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel-body table-responsive" id="dvusuarios" hidden="hidden">
                              <h4 class="modal-title">Usuarios</h4>
                                  <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>idUS:</label>
                                      <input type="text" class="form-control" name="idUS" id="idUS" maxlength="250" placeholder="idusuario">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>Glosa:</label>
                                      <select name="glosaus" id="glosaus" class="form-control">
                                        <?php
                                          $rspta = $opciones->glosas();
                                          while ($reg=$rspta->fetch_object()){
                                                echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                          }
                                         ?>
                                      </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>Valor glosa:</label>
                                      <input type="text" class="form-control" name="valorglosaus" id="valorglosaus" maxlength="20" placeholder="Valor Glosa">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>Devolución:</label>
                                      <input type="text" class="form-control" name="devolucionus" id="devolucionus" maxlength="50" placeholder="Devolución">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>Nota Crédito:</label>
                                      <input type="text" class="form-control" name="notacreditous" id="notacreditous" maxlength="20" placeholder="Nota Crédito">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <label>Observaciones:</label>
                                      <input type="text" class="form-control" name="observacionesus" id="observacionesus" maxlength="250" placeholder="Observaciones">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                      <button class="btn btn-primary" type="button" id="btnGuardarus"><i class="fa fa-save"></i> Guardar</button>
                                    </div>
                                 </form>
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
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>
                          <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvconsulta" hidden="hidden">
                                      <h4 class="modal-title">Consulta</h4>

                                    <form name="formulario" id="formulario" method="POST">
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>idAC:</label>
                                        <input type="text" class="form-control" name="idAC" id="idAC" maxlength="250" placeholder="idAC">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Glosa:</label>
                                        <select name="glosac" id="glosac" class="form-control">
                                          <?php
                                            $rspta = $opciones->glosas();
                                            while ($reg=$rspta->fetch_object()){
                                                  echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                            }

                                           ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Valor glosa:</label>
                                        <input type="text" class="form-control" name="valorglosac" id="valorglosac" maxlength="20" placeholder="Valor Glosa">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Devolución:</label>
                                        <input type="text" class="form-control" name="devolucionc" id="devolucionc" maxlength="50" placeholder="Devolución">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nota Crédito:</label>
                                        <input type="text" class="form-control" name="notacreditoc" id="notacreditoc" maxlength="20" placeholder="Nota Crédito">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Observaciones:</label>
                                        <input type="text" class="form-control" name="observacionesc" id="observacionesc" maxlength="250" placeholder="Observaciones">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="button" id="btnGuardarc"><i class="fa fa-save"></i> Guardar</button>
                                      </div>
                                   </form>


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
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                            <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvprocedimiento" hidden="hidden">
                                <h4 class="modal-title">Procedimientos</h4>
                                    <form name="formulario" id="formulario" method="POST">
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>idAP:</label>
                                        <input type="text" class="form-control" name="idAP" id="idAP" maxlength="250" placeholder="idAP">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Glosa:</label>
                                        <select name="glosap" id="glosap" class="form-control">
                                          <?php
                                            $rspta = $opciones->glosas();
                                            while ($reg=$rspta->fetch_object()){
                                                  echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                            }

                                           ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Valor glosa:</label>
                                        <input type="text" class="form-control" name="valorglosap" id="valorglosap" maxlength="20" placeholder="Valor Glosa">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Devolución:</label>
                                        <input type="text" class="form-control" name="devolucionp" id="devolucionp" maxlength="50" placeholder="Devolución">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nota Crédito:</label>
                                        <input type="text" class="form-control" name="notacreditop" id="notacreditop" maxlength="20" placeholder="Nota Crédito">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Observaciones:</label>
                                        <input type="text" class="form-control" name="observacionesp" id="observacionesp" maxlength="250" placeholder="Observaciones">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="button" id="btnGuardarp"><i class="fa fa-save"></i> Guardar</button>
                                      </div>
                                   </form>
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
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                            <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvurgencias" hidden="hidden">
                                <h4 class="modal-title">Urgencias</h4>
                                    <form name="formulario" id="formulario" method="POST">
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>idAU:</label>
                                        <input type="text" class="form-control" name="idAU" id="idAU" maxlength="250" placeholder="idAU">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Glosa:</label>
                                        <select name="glosau" id="glosau" class="form-control">
                                          <?php
                                            $rspta = $opciones->glosas();
                                            while ($reg=$rspta->fetch_object()){
                                                  echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                            }
                                           ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Valor glosa:</label>
                                        <input type="text" class="form-control" name="valorglosau" id="valorglosau" maxlength="20" placeholder="Valor Glosa">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Devolución:</label>
                                        <input type="text" class="form-control" name="devolucionu" id="devolucionu" maxlength="50" placeholder="Devolución">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nota Crédito:</label>
                                        <input type="text" class="form-control" name="notacreditou" id="notacreditou" maxlength="20" placeholder="Nota Crédito">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Observaciones:</label>
                                        <input type="text" class="form-control" name="observacionesu" id="observacionesu" maxlength="250" placeholder="Observaciones">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="button" id="btnGuardaru"><i class="fa fa-save"></i> Guardar</button>
                                      </div>
                                   </form>
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
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                            <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvhospitalizacion" hidden="hidden">
                                <h4 class="modal-title">Hospitalizacion</h4>
                                    <form name="formulario" id="formulario" method="POST">
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>idAH:</label>
                                        <input type="text" class="form-control" name="idAH" id="idAH" maxlength="250" placeholder="idAH">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Glosa:</label>
                                        <select name="glosah" id="glosah" class="form-control">
                                          <?php
                                            $rspta = $opciones->glosas();
                                            while ($reg=$rspta->fetch_object()){
                                                  echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                            }

                                           ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Valor glosa:</label>
                                        <input type="text" class="form-control" name="valorglosah" id="valorglosah" maxlength="20" placeholder="Valor Glosa">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Devolución:</label>
                                        <input type="text" class="form-control" name="devolucionh" id="devolucionh" maxlength="50" placeholder="Devolución">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nota Crédito:</label>
                                        <input type="text" class="form-control" name="notacreditoh" id="notacreditoh" maxlength="20" placeholder="Nota Crédito">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Observaciones:</label>
                                        <input type="text" class="form-control" name="observacionesh" id="observacionesh" maxlength="250" placeholder="Observaciones">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="button" id="btnGuardarh"><i class="fa fa-save"></i> Guardar</button>
                                      </div>
                                   </form>
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
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                            <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvnacidos" hidden="hidden">
                                <h4 class="modal-title">Nacidos</h4>
                                    <form name="formulario" id="formulario" method="POST">
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>idAN:</label>
                                        <input type="text" class="form-control" name="idAN" id="idAN" maxlength="250" placeholder="idAN">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Glosa:</label>
                                        <select name="glosan" id="glosan" class="form-control">
                                          <?php
                                            $rspta = $opciones->glosas();
                                            while ($reg=$rspta->fetch_object()){
                                                  echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                            }
                                           ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Valor glosa:</label>
                                        <input type="text" class="form-control" name="valorglosan" id="valorglosan" maxlength="20" placeholder="Valor Glosa">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Devolución:</label>
                                        <input type="text" class="form-control" name="devolucionn" id="devolucionn" maxlength="50" placeholder="Devolución">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nota Crédito:</label>
                                        <input type="text" class="form-control" name="notacrediton" id="notacrediton" maxlength="20" placeholder="Nota Crédito">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Observaciones:</label>
                                        <input type="text" class="form-control" name="observacionesn" id="observacionesn" maxlength="250" placeholder="Observaciones">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="button" id="btnGuardarn"><i class="fa fa-save"></i> Guardar</button>
                                      </div>
                                   </form>
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
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                            <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvmedicamentos" hidden="hidden">
                                <h4 class="modal-title">Medicamentos</h4>
                                    <form name="formulario" id="formulario" method="POST">
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>idAM:</label>
                                        <input type="text" class="form-control" name="idAM" id="idAM" maxlength="250" placeholder="idAM">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Glosa:</label>
                                        <select name="glosam" id="glosam" class="form-control">
                                          <?php
                                            $rspta = $opciones->glosas();
                                            while ($reg=$rspta->fetch_object()){
                                                  echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                            }
                                           ?>
                                        </select>
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Valor glosa:</label>
                                        <input type="text" class="form-control" name="valorglosam" id="valorglosam" maxlength="20" placeholder="Valor Glosa">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Devolución:</label>
                                        <input type="text" class="form-control" name="devolucionm" id="devolucionm" maxlength="50" placeholder="Devolución">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nota Crédito:</label>
                                        <input type="text" class="form-control" name="notacreditom" id="notacreditom" maxlength="20" placeholder="Nota Crédito">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Observaciones:</label>
                                        <input type="text" class="form-control" name="observacionesm" id="observacionesm" maxlength="250" placeholder="Observaciones">
                                      </div>
                                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="button" id="btnGuardarm"><i class="fa fa-save"></i> Guardar</button>
                                      </div>
                                   </form>
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
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                            <!-- /.modal -->

                            <div class="panel-body table-responsive" id="dvotros" hidden="hidden">
                              <h4 class="modal-title">Otros</h4>
                              <form name="formulario" id="formulario" method="POST">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>idAT:</label>
                                  <input type="text" class="form-control" name="idAT" id="idAT" maxlength="250" placeholder="idAT">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Glosa:</label>
                                  <select name="glosat" id="glosat" class="form-control">
                                    <?php
                                      $rspta = $opciones->glosas();
                                      while ($reg=$rspta->fetch_object())
                                      {
                                        echo "<option value='".$reg->codigo."'>".$reg->codigo." - ".$reg->descripcion."</option>";
                                      }
                                  ?>
                                  </select>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Valor glosa:</label>
                                  <input type="text" class="form-control" name="valorglosat" id="valorglosat" maxlength="20" placeholder="Valor Glosa">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Devolución:</label>
                                  <input type="text" class="form-control" name="devoluciont" id="devoluciont" maxlength="50" placeholder="Devolución">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Nota Crédito:</label>
                                  <input type="text" class="form-control" name="notacreditot" id="notacreditot" maxlength="20" placeholder="Nota Crédito">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Observaciones:</label>
                                  <input type="text" class="form-control" name="observacionest" id="observacionest" maxlength="250" placeholder="Observaciones">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <button class="btn btn-primary" type="button" id="btnGuardart"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                              </form>
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
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="modal-7">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Otros</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>Aqui va el cod...</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Guardar</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

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

<script type="text/javascript" src="scripts/cuentasmedicas.js"></script>

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
                  url: '../ajax/cuentasmedicas.php?op=buscarAC&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardarc").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAC&idAF='+$("#numerofactura").val()+'&idAC='+$("#idAC").val()+'&valorglosa='+$("#valorglosac").val()+'&glosa='+$("#glosac").val()+'&devolucionc='+$("#devolucionc").val()+'&notacreditoc='+$("#notacreditoc").val()+'&observacionesc='+$("#observacionesc").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarAP&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardarp").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAP&idAF='+$("#numerofactura").val()+'&idAP='+$("#idAP").val()+'&valorglosa='+$("#valorglosap").val()+'&glosa='+$("#glosap").val()+'&devolucion='+$("#devolucionp").val()+'&notacredito='+$("#notacreditop").val()+'&observaciones='+$("#observacionesp").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarAU&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardaru").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAU&idAF='+$("#numerofactura").val()+'&idAU='+$("#idAU").val()+'&valorglosa='+$("#valorglosau").val()+'&glosa='+$("#glosau").val()+'&devolucion='+$("#devolucionu").val()+'&notacredito='+$("#notacreditou").val()+'&observaciones='+$("#observacionesu").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarAH&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardarh").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAH&idAF='+$("#numerofactura").val()+'&idAH='+$("#idAH").val()+'&valorglosa='+$("#valorglosac").val()+'&glosa='+$("#glosac").val()+'&devolucion='+$("#devolucionh").val()+'&notacredito='+$("#notacreditoh").val()+'&observaciones='+$("#observacionesh").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarAN&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardarn").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAN&idAF='+$("#numerofactura").val()+'&idAN='+$("#idAN").val()+'&valorglosa='+$("#valorglosan").val()+'&glosa='+$("#glosan").val()+'&devolucion='+$("#devolucionn").val()+'&notacredito='+$("#notacrediton").val()+'&observaciones='+$("#observacionesn").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarAM&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardarm").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAM&idAF='+$("#numerofactura").val()+'&idAM='+$("#idAM").val()+'&valorglosa='+$("#valorglosam").val()+'&glosa='+$("#glosam").val()+'&devolucion='+$("#devolucionm").val()+'&notacredito='+$("#notacreditom").val()+'&observaciones='+$("#observacionesm").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarUS&idAF='+$("#numerofactura").val(),
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

    $("#btnGuardarus").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateUS&idAF='+$("#numerofactura").val()+'&idUS='+$("#idUS").val()+'&valorglosa='+$("#valorglosaus").val()+'&glosa='+$("#glosaus").val()+'&devolucion='+$("#devolucionus").val()+'&notacredito='+$("#notacreditous").val()+'&observaciones='+$("#observacionesus").val(),
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


    $("#btnGuardarf_").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAF&idAF='+$("#numerofactura").val()+'&valorglosa='+$("#valorglosa").val()+'&glosa='+$("#glosa").val()+'&devolucion='+$("#devolucion").val()+'&notacredito='+$("#notacredito").val()+'&observaciones='+$("#observaciones").val(),
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
                  url: '../ajax/cuentasmedicas.php?op=buscarAT&idAF='+$("#numerofactura").val(),
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


    $("#btnGuardart").click(function() {
          //$("#dvconsulta").hide();
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
                  url: '../ajax/cuentasmedicas.php?op=updateAT&idAF='+$("#numerofactura").val()+'&idAT='+$("#idAT").val()+'&valorglosa='+$("#valorglosat").val()+'&glosa='+$("#glosat").val()+'&devoluciont='+$("#devoluciont").val()+'&notacreditot='+$("#notacreditot").val()+'&observacionest='+$("#observacionest").val(),
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
                    url: '../ajax/cuentasmedicas.php?op=buscar&fechainicio='+$("#fechainicio").val()+'&fechafin='+$("#fechafin").val()+'&factura='+$("#numfactura").val()+'&identificacion='+$("#numiden").val(),
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


      function mostrarhistorial(factura) {
            mostrarform(2);
            tabla=$('#tbllistadohistorial').dataTable(
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
                    url: '../ajax/cuentasmedicas.php?op=mostrarhistorial&factura='+factura,
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
      };
  </script>

<?php
}
ob_end_flush();
?>
