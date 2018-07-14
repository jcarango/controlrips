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
                         <h1 class="box-title"> Informe Archivo de consulta - US: Por rango de fechas</h1>
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
                      $query = "SELECT * FROM US WHERE fecharadicado BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idUS' ASC";
                      $result = mysqli_query($conexion, $query);
                    ?>
                    <table id='datatable-buttons' class='table table-striped table-bordered'>
                      <thead>
                          <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Número</th>
                            <th>Entidad</th>
                            <th>Tipo Usuario</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Primer Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Edad</th>
                            <th>Unidad Medida Edad</th>
                            <th>Sexo</th>
                            <th>Cod Depto</th>
                            <th>Cod Municipio</th>
                            <th>Zona Residencia</th>
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
                            <td>".$row[9]."</td>
                            <td>".$row[10]."</td>
                            <td>".$row[11]."</td>
                            <td>".$row[12]."</td>
                            <td>".$row[13]."</td>
                            <td>".$row[14]."</td>
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