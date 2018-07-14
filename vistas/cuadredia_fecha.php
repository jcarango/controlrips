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
                         <h1 class="box-title"> Cuadre del Día: Por rango de fechas</h1>
                        <div class="box-tools pull-right">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <?php
                    $fechainicio = $_POST['fechainicio'];
                    $fechafin = $_POST['fechafin'];
                    echo "<h3>Esta consulta es desde el ".$fechainicio." hasta el ".$fechafin."</h3>";
                      require "../config/Conexion.php";
                      $query = "SELECT * FROM totaldia WHERE fechaingreso BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idtotaldia' ASC";
                      $result = mysqli_query($conexion, $query);
                    ?>
                    <table id='datatable-buttons' class='table table-striped table-bordered'>
                      <thead>
                          <tr>
                          <th>ID</th>
                          <th>Total AF</th>
                          <th>Total AT</th>
                          <th>Total AM</th>
                          <th>Total AC</th>
                          <th>Total AP</th>
                          <th>Diferencia</th>
                          <th>Fecha de ingreso</th>
                          <th>Usuario</th>
                        </tr>
                      </thead>
                        <?php
                        $i = 0 ;
                          while ($row = mysqli_fetch_row($result))
                          {
                          echo 
                          "<tr>
                            <td>".$row[0]."</td>
                            <td>".$row[1]."</td>
                            <td>".$row[2]."</td>
                            <td>".$row[3]."</td>
                            <td>".$row[4]."</td>
                            <td>".$row[5]."</td>
                            <td>".$row[6]."</td>
                            <td>".$row[7]."</td>
                            <td>".$row[8]."</td>
                          </tr>";
                          $totalAF=$row[1]+$totalAF;
                          $totalAT=$row[2]+$totalAT;
                          $totalAM=$row[3]+$totalAM;
                          $totalAC=$row[4]+$totalAC;
                          $totalAP=$row[5]+$totalAP;
                          $diferencia=$row[6]+$diferencia;
                          $i++;
                          }
                          echo "</table></body></html>";
                        ?>
                        <div class="col-md-2">
                          <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Total AF</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <?php echo number_format($totalAF); ?>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                          <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Total AT</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <?php echo number_format($totalAT); ?>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                          <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Total AM</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <?php echo number_format($totalAM); ?>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                          <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Total AC</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <?php echo number_format($totalAC); ?>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                          <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Total AP</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <?php echo number_format($totalAP); ?>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                          <div class="box box-success">
                            <div class="box-header with-border">
                              <h3 class="box-title">Diferencia</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                              <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <?php echo number_format($diferencia); ?>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </table>
                </div>
            </div>
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
}
ob_end_flush();
?>