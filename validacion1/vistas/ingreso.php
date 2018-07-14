<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
require_once "../modelos/Consultas.php";

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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                	<h1>Subir Multiples Archivos</h1>
                  <!-- Formulario para subir los archivos -->
						      <div class="mensage"> </div>      
                    <table align="center">
			                <tr>
			                  <td><input type="file" multiple="multiple" id="archivos"></td>
                        <td> </td>
                        <td><button id="enviar" class="btn btn-primary">Subir los Archivos</button></td>
			                </tr>   
			              </table>
                </div>
                  </div>
                </div>
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
}
ob_end_flush();
?>