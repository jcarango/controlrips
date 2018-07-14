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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Cambio de Estados <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Cod Prestador</th>
                          <th>Razón Social</th>
                          <th>Tipo Identificaión</th>
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
                          <th>Glosa</th>
                          <th>Valor Glosa</th>
                          <th>Devolucion</th>
                          <th>Nota Crédito</th>
                          <th>Observaciones</th>
                          <th>Usuario</th>
                          <th>Estado</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <th>Opciones</th>
                          <th>Cod Prestador</th>
                          <th>Razón Social</th>
                          <th>Tipo Identificaión</th>
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
                          <th>Glosa</th>
                          <th>Valor Glosa</th>
                          <th>Devolucion</th>
                          <th>Nota Crédito</th>
                          <th>Usuario</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <!--<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>ID:</label>
                            <input type="text" class="form-control" name="idAF" id="idAF" disabled>
                          </div>-->
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Codigo prestador:</label>
                            <input type="hidden" name="idAF" id="idAF">
                            <input type="text" class="form-control" name="codprestadorservicio" id="codprestadorservicio">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Razón Social:</label>
                            <input type="text" class="form-control" name="razonsocial" id="razonsocial">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tipo Identificación:</label>
                            <input type="text" class="form-control" name="tipoidentificacion" id="tipoidentificacion">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Número Identificación:</label>
                            <input type="text" class="form-control" name="numeroidentificacion" id="numeroidentificacion">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Número Factura:</label>
                            <input type="text" class="form-control" name="numerofactura" id="numerofactura">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>fecha Exp Factura:</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" name="fechaexpedicionfactura" id="fechaexpedicionfactura">
                            </div>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha Ini Factura:</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control" name="fechainiciofactura" id="fechainiciofactura">
                            </div>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha Fin Factura:</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control" name="fechafinalfactura" id="fechafinalfactura">
                            </div>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Cod Administradora:</label>
                            <input type="text" class="form-control" name="codigoentidadadministradora" id="codigoentidadadministradora">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Nombre Administradora:</label>
                            <input type="text" class="form-control" name="nombreentidadadministradora" id="nombreentidadadministradora">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Número Contácto:</label>
                            <input type="text" class="form-control" name="numerocontacto" id="numerocontacto">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Plan Beneficios:</label>
                            <input type="text" class="form-control" name="plandebeneficios" id="plandebeneficios">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Número Póliza:</label>
                            <input type="text" class="form-control" name="numerodepoliza" id="numerodepoliza">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor Copago:</label>
                            <input type="text" class="form-control" name="valorcopago" id="valorcopago">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor Comisión:</label>
                            <input type="text" class="form-control" name="valorcomision" id="valorcomision">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor Descuentos:</label>
                            <input type="text" class="form-control" name="valordescuentos" id="valordescuentos">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor Neto:</label>
                            <input type="text" class="form-control" name="valorneto" id="valorneto">
                          </div><div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Fecha Radicado:</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control" name="fecharadicado" id="fecharadicado">
                            </div>
                          </div>
                          <!--<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Glosa:</label>
                            <input type="text" class="form-control" name="glosa" id="glosa">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Valor Glosa:</label>
                            <input type="text" class="form-control" name="valorglosa" id="valorglosa">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Devolución:</label>
                            <input type="text" class="form-control" name="devolucion" id="devolucion">
                          </div><div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Nota Crédito:</label>
                            <input type="text" class="form-control" name="notacredito" id="notacredito">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Observaciones:</label>
                            <input type="text" class="form-control" name="observaciones" id="observaciones">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Estado:</label>
                            <input type="text" class="form-control" name="estado" id="estado">
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Estado Persistencia:</label>
                            <input type="text" class="form-control" name="estadopersistencia" id="estadopersistencia">
                          </div>-->

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

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

<script type="text/javascript" src="scripts/cambioestado.js"></script>
<?php 
}
ob_end_flush();
?>