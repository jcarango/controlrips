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
                         <h1 class="box-title"> Informe Archivo de consulta - CT: Por rango de fechas</h1>
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
                      $query = "SELECT * FROM CT WHERE fecha BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idCT' ASC";
                      $result = mysqli_query($conexion, $query);
                    ?>
                    <table id='datatable-buttons' class='table table-striped table-bordered'>
                      <thead>
                          <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Cod Prestador</th>
                            <th>Fecha Remision</th>
                            <th>Cod Archivo</th>
                            <th>Total Registros</th>
                            <th>Nombre Archivo</th>
                          </thead>
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
                          </tr>";
                          $i++;
                          }
                         echo "</table></body></html>";
                        ?>
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