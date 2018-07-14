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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <div id="rootwizard">
                    <div class="navbar">
                      <div class="navbar-inner">
                        <div class="container">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">First</a></li>
                      <li><a href="#tab2" data-toggle="tab">Second</a></li>
                      <li><a href="#tab3" data-toggle="tab">Third</a></li>
                      <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                      <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                      <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                      <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                    </ul>
                     </div>
                      </div>
                    </div>
                      <div id="bar" class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                      </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                          1
                        </div>
                        <div class="tab-pane" id="tab2">
                          2
                        </div>
                      <div class="tab-pane" id="tab3">
                        3
                        </div>
                      <div class="tab-pane" id="tab4">
                        4
                        </div>
                      <div class="tab-pane" id="tab5">
                        5
                        </div>
                      <div class="tab-pane" id="tab6">
                        6
                        </div>
                      <div class="tab-pane" id="tab7">
                        7
                        </div>
                      <ul class="pager wizard">
                        <li class="previous first" style="display:none;"><a href="#">First</a></li>
                        <li class="previous"><a href="#">Previous</a></li>
                        <li class="next last" style="display:none;"><a href="#">Last</a></li>
                          <li class="next"><a href="#">Next</a></li>
                      </ul>
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