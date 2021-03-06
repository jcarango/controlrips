<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

$ruta = '../files/rips/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
    if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Continuamos 
        {
            $NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
            $temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
            $prefijo = "SumiMedical";
            $nombrearchivo = $prefijo."_".$NombreOriginal;
            $Destino = $ruta.$nombrearchivo;   //Creamos una ruta de destino con la variable ruta y el nombre original del archivo
            move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada

            //Incluímos inicialmente la conexión a la base de datos
            require "../config/Conexion.php";

            //recibimos las variables enviadas por el formulario  
            $datos = extract($_POST);
            $usuario=$_SESSION['login'];

            //Obtengo la clase del archivo, para archivarlo en su respectiva tabla.
            $clasearchivo = mb_substr($NombreOriginal,0,2);
            $hoy = date("Y-m-d H:i:s");
            $usuario=$_SESSION['login'];
            $open = fopen($Destino,'r');
            //Almacenamos el archivo en una tabla.
            $qrys = "INSERT INTO archivos (nombre, fecha, usuario) VALUES('$nombrearchivo', '$hoy', '$usuario')";
                  mysqli_query($conexion,$qrys);

            switch ($clasearchivo) {

                case "CT":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);

                 list($codprestadorservicio, $fecharemision, $codarchivo, $totalregistros) = $explodeLine;

                 $date = str_replace('/', '-', $fecharemision);
                 $fecharemision1 = date('Y-m-d', strtotime($date));

                if (empty($codprestadorservicio)){
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                  } else { 
                  $qry = "INSERT INTO CT (fecha, usuario, codprestadorservicio, fecharemision, codarchivo, totalregistros, nomarchivo) VALUES('$hoy', '$usuario', '$codprestadorservicio', '$fecharemision1', '$codarchivo', '$totalregistros', '$nombrearchivo')";
                  mysqli_query($conexion,$qry);
                  }
                } 
                    fclose($open);
               break;

               case "AF":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto) = $explodeLine;
                 if ($tipoidentificacion=='NI')
                 {
                  $numeroidentificacion = mb_substr($numeroidentificacion,0,9);
                 }

                 $date = str_replace('/', '-', $fechaexpedicionfactura);
                 $fechaexpedicionfactura1 = date('Y-m-d', strtotime($date));

                 $date = str_replace('/', '-', $fechainiciofactura);
                 $fechainiciofactura1 = date('Y-m-d', strtotime($date));

                 $date = str_replace('/', '-', $fechafinalfactura);
                 $fechafinalfactura1 = date('Y-m-d', strtotime($date));

                 //totales cuadre de dia
                 $totalAF=$totalAF+$valorneto;

                 if (empty($codprestadorservicio)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                  } else {
                    $qry = "INSERT INTO AF (codprestadorservicio, razonsocial, tipoidentificacion, numeroidentificacion, numerofactura, fechaexpedicionfactura, fechainiciofactura, fechafinalfactura, codigoentidadadministradora, nombreentidadadministradora, numerocontacto, plandebeneficios, numerodepoliza, valorcopago, valorcomision, valordescuentos, valorneto, fecharadicado, usuariocarga, archivocarga) VALUES('$codprestadorservicio', '$razonsocial', '$tipoidentificacion', '$numeroidentificacion', '$numerofactura', '$fechaexpedicionfactura1', '$fechainiciofactura1', '$fechafinalfactura1', '$codigoentidadadministradora', '$nombreentidadadministradora', '$numerocontacto', '$plandebeneficios', '$numerodepoliza', '$valorcopago', '$valorcomision', '$valordescuentos', '$valorneto', '$hoy', '$usuario', '$nombrearchivo')";
                    mysqli_query($conexion,$qry);
                  }
                }
                fclose($open);
              break;

              case "US":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($tipoidentificacion, $numeroidentificacion, $codigoentidadadministradora, $tipousuario, $primerapellido, $segundoapellido, $primernombre, $segundonombre, $edad, $unidadmedidadedad, $sexo, $codigodepartamento, $codigomunicipio, $zonaresidencia) = $explodeLine;

                 if (empty($numeroidentificacion)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO US (tipoidentificacion, numeroidentificacion, codigoentidadadministradora, tipousuario, primerapellido, segundoapellido, primernombre, segundonombre, edad, unidadmedidadedad, sexo, codigodepartamento, codigomunicipio, zonaresidencia, fecharadicado) VALUES('$tipoidentificacion', '$numeroidentificacion', '$codigoentidadadministradora', '$tipousuario', '$primerapellido', '$segundoapellido', '$primernombre', '$segundonombre', '$edad', '$unidadmedidadedad', '$sexo', '$codigodepartamento', '$codigomunicipio', '$zonaresidencia', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AC":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacion, $numeroidentificacion, $fechaconsulta, $numeroautorizacion, $codigoconsulta, $finalidadconsulta, $causaexterna, $codigodiagnosticoprincipal, $codigodiagnósticorelacionado1, $codigodiagnósticorelacionado2, $codigodiagnósticorelacionad3, $tipodiagnósticoprincipal, $valorconsulta, $valorcopago, $valorneto) = $explodeLine;

                 $date = str_replace('/', '-', $fechaconsulta);
                 $fechaconsulta1 = date('Y-m-d', strtotime($date));

                 //totales cuadre de dia
                 $totalAC=$totalAC+$valorneto;

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AC (numerofactura, codigoprestadorserviciossalud, tipoidentificacion, numeroidentificacion, fechaconsulta, numeroautorizacion, codigoconsulta, finalidadconsulta, causaexterna, codigodiagnosticoprincipal, codigodiagnósticorelacionado1, codigodiagnósticorelacionado2, codigodiagnósticorelacionad3, tipodiagnósticoprincipal, valorconsulta, valorcopago, valorneto, fecharadicado) VALUES('$numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacion', '$numeroidentificacion', '$fechaconsulta1', '$numeroautorizacion', '$codigoconsulta', '$finalidadconsulta', '$causaexterna', '$codigodiagnosticoprincipal', '$codigodiagnósticorelacionado1', '$codigodiagnósticorelacionado2', '$codigodiagnósticorelacionad3', '$tipodiagnósticoprincipal', '$valorconsulta', '$valorcopago', '$valorneto','$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AP":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacion, $numeroidentificacion, $fechaprocedimiento, $numeroautorizacion, $codigoprocedimiento, $ambitorealizacionprocedimiento, $finalidadprocedimiento, $personalqueatiende, $diagnosticoprincipal, $diagnosticorelacionado, $complicacion, $formarealizacionactoquirurgico, $valorprocedimiento) = $explodeLine;

                 $date = str_replace('/', '-', $fechaprocedimiento);
                 $fechaprocedimiento1 = date('Y-m-d', strtotime($date));

                 //totales cuadre de dia
                 $totalAP=$totalAP+$valorprocedimiento;

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AP (numerofactura, codigoprestadorserviciossalud, tipoidentificacion, numeroidentificacion, fechaprocedimiento, numeroautorizacion, codigoprocedimiento, ambitorealizacionprocedimiento, finalidadprocedimiento, personalqueatiende, diagnosticoprincipal, diagnosticorelacionado, complicacion, formarealizacionactoquirurgico, valorprocedimiento, fecharadicado) VALUES('$numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacion', '$numeroidentificacion', '$fechaprocedimiento1', '$numeroautorizacion', '$codigoprocedimiento', '$ambitorealizacionprocedimiento', '$finalidadprocedimiento', '$personalqueatiende', '$diagnosticoprincipal', '$diagnosticorelacionado', '$complicacion', '$formarealizacionactoquirurgico', '$valorprocedimiento', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AU":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacion, $numeroidentificacion, $fechaingresousuario, $horaingreso, $numeroautorizacion, $causaexterna, $diagnosticosalida, $diagnosticorelacionadosalida1, $diagnosticorelacionadosalida2, $diagnosticorelacionadosalida3, $destinousuariosalidaobservacion, $estadosalida, $causabasicamuerteurgencias, $fechasalidaobservacion, $horasalidaobservacion
              ) = $explodeLine;

                 $date = str_replace('/', '-', $fechaingresousuario);
                 $fechaingresousuario1 = date('Y-m-d', strtotime($date));

                 $date = str_replace('/', '-', $fechasalidaobservacion);
                 $fechasalidaobservacion1 = date('Y-m-d', strtotime($date));

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AU (numerofactura, codigoprestadorserviciossalud, tipoidentificacion, numeroidentificacion, fechaingresousuario, horaingreso, numeroautorizacion, causaexterna, diagnosticosalida, diagnosticorelacionadosalida1, diagnosticorelacionadosalida2, diagnosticorelacionadosalida3, destinousuariosalidaobservacion, estadosalida, causabasicamuerteurgencias, fechasalidaobservacion, horasalidaobservacion, fecharadicado) VALUES('$numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacion', '$numeroidentificacion', '$fechaingresousuario1', '$horaingreso', '$numeroautorizacion', '$causaexterna', '$diagnosticosalida', '$diagnosticorelacionadosalida1', '$diagnosticorelacionadosalida2', '$diagnosticorelacionadosalida3', '$destinousuariosalidaobservacion', '$estadosalida', '$causabasicamuerteurgencias', '$fechasalidaobservacion1', '$horasalidaobservacion', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AH":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacion, $numeroidentificacion, $viaingresoinstitución, $fechaingreso, $horaingreso, $numeroautorizacion, $causaexterna, $diagnosticoprincipalingreso, $diagnosticoprincipalegreso, $diagnosticorelacionadoegreso1, $diagnosticorelacionadoegreso2, $diagnosticorelacionadoegreso3, $estadosalida, $diagnosticocausabasicamuerte, $fechaegreso, $horaegreso) = $explodeLine;

                 $date = str_replace('/', '-', $fechaingreso);
                 $fechaingreso1 = date('Y-m-d', strtotime($date));

                 $date = str_replace('/', '-', $fechaegreso);
                 $fechaegreso1 = date('Y-m-d', strtotime($date));

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AH (numerofactura, codigoprestadorserviciossalud, tipoidentificacion, numeroidentificacion, viaingresoinstitución, fechaingreso, horaingreso, numeroautorizacion, causaexterna, diagnosticoprincipalingreso, diagnosticoprincipalegreso, diagnosticorelacionadoegreso1, diagnosticorelacionadoegreso2, diagnosticorelacionadoegreso3, estadosalida, diagnosticocausabasicamuerte, fechaegreso, horaegreso, fecharadicado) VALUES('$numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacion', '$numeroidentificacion', '$viaingresoinstitución', '$fechaingreso1', '$horaingreso', '$numeroautorizacion', '$causaexterna', '$diagnosticoprincipalingreso', '$diagnosticoprincipalegreso', '$diagnosticorelacionadoegreso1', '$diagnosticorelacionadoegreso2', '$diagnosticorelacionadoegreso3', '$estadosalida', '$diagnosticocausabasicamuerte', '$fechaegreso1', '$horaegreso', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AN":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacionmadre, $numeroidentificacion, $fechanacimiento, $edadgestacional, $controlprenatal, $sexo, $peso, $diagnosticoreciennacido, $causabasicamuerte, $fechamuerte, $hora) = $explodeLine;

                 $date = str_replace('/', '-', $fechanacimiento);
                 $fechanacimiento1 = date('Y-m-d', strtotime($date));

                 $date = str_replace('/', '-', $fechamuerte);
                 $fechamuerte = date('Y-m-d', strtotime($date));

                if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                } else {
                $qry = "INSERT INTO AN (numerofactura, codigoprestadorserviciossalud, tipoidentificacionmadre, numeroidentificacion, fechanacimiento, edadgestacional, controlprenatal, sexo, peso, diagnosticoreciennacido, causabasicamuerte, fechamuerte, hora, fecharadicado) VALUES($numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacionmadre', '$numeroidentificacion', '$fechanacimiento1', '$edadgestacional', '$controlprenatal', '$sexo', '$peso', '$diagnosticoreciennacido', '$causabasicamuerte', '$fechamuerte1', '$hora', '$hoy')";
                mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AM":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacion, $numeroidentificacion, $numeroautorizacion, $codigomedicamento, $tipomedicamento, $nombregenericomedicamento, $formafarmaceutica, $concentracionmedicamento, $unidadmedidamedicamento, $numerounidades, $valorunitariomedicamento, $valortotalmedicamento) = $explodeLine;

                 //totales cuadre de dia
                 $totalAM=$totalAM+$valortotalmedicamento;

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AM (numerofactura, codigoprestadorserviciossalud, tipoidentificacion, numeroidentificacion, numeroautorizacion, codigomedicamento, tipomedicamento, nombregenericomedicamento, formafarmaceutica, concentracionmedicamento, unidadmedidamedicamento, numerounidades, valorunitariomedicamento, valortotalmedicamento, fecharadicado) VALUES('$numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacion', '$numeroidentificacion', '$numeroautorizacion', '$codigomedicamento', '$tipomedicamento', '$nombregenericomedicamento', '$formafarmaceutica', '$concentracionmedicamento', '$unidadmedidamedicamento', '$numerounidades', '$valorunitariomedicamento', '$valortotalmedicamento', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AT":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codigoprestadorserviciossalud, $tipoidentificacion, $numeroidentificacion, $numeroautorizacion, $tiposervicio, $codigoservicio, $nombreservicio, $cantidad, $valorunitariomaterialinsumo, $valortotalmaterial) = $explodeLine;

                 //totales cuadre de dia
                 $totalAT=$totalAT+$valortotalmaterial;

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AT (numerofactura, codigoprestadorserviciossalud, tipoidentificacion, numeroidentificacion, numeroautorizacion, tiposervicio, codigoservicio, nombreservicio, cantidad, valorunitariomaterialinsumo, valortotalmaterial, fecharadicado) VALUES('$numerofactura', '$codigoprestadorserviciossalud', '$tipoidentificacion', '$numeroidentificacion', '$numeroautorizacion', '$tiposervicio', '$codigoservicio', '$nombreservicio', '$cantidad', '$valorunitariomaterialinsumo', '$valortotalmaterial', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
               break;

              case "AD":
                while (!feof($open)) 
                {
                 $getTextLine = fgets($open);
                 $explodeLine = explode(",",$getTextLine);
                 
                 list($numerofactura, $codprestadorservicio, $codigodeconcepto, $cantidad, $valorunitario, $valortotal) = $explodeLine;

                 if (empty($numerofactura)){ 
                  if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
                    {
                      $mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
                    }
                 } else {
                 $qry = "INSERT INTO AD (numerofactura, codprestadorservicio, codigodeconcepto, cantidad, valorunitario, valortotal, fecharadicado) VALUES('$numerofactura', '$codprestadorservicio', '$codigodeconcepto', '$cantidad', '$valorunitario', '$valortotal', '$hoy')";
                 mysqli_query($conexion,$qry);
               }
                }
                fclose($open);
              break;

              default:
                ?>
                  <div class="col-md-9">
                    <div class="box box-widget widget-user">
                      <div class="widget-user-header bg-red">
                        <h1 class="widget-user-username">Archivo no corresponde a la estructura</h1>
                      </div>
                    </div>
                  </div>
                <?php
              }
            }
    if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
        {
            $mensage .= 'No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: \n'.$key['error']; 
        }
    
}
//Totales del dia
$totaldia=$totalAT+$totalAM+$totalAC+$totalAP-$totalAF;
$qry = "INSERT INTO totaldia (totalAF, totalAT, totalAM, totalAC, totalAP, diferencia, fechaingreso, usuario) VALUES('$totalAF', '$totalAT', '$totalAM', '$totalAC', '$totalAP', '$totaldia', '$hoy', '$usuario')";
mysqli_query($conexion,$qry);
?>

<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
  <thead>
    <tr>
      <td><strong>Total AF</strong></td>
      <td><strong>Total AT</strong></td>
      <td><strong>Total AM</strong></td>
      <td><strong>Total AC</strong></td>
      <td><strong>Total AP</strong></td>
      <td><strong>Diferencia</strong></td>
    </tr>
  </thead>
<tr>
  <td><?php echo "$".number_format($totalAF); ?></td>
  <td><?php echo "$".number_format($totalAT); ?></td>
  <td><?php echo "$".number_format($totalAM); ?></td>
  <td><?php echo "$".number_format($totalAC); ?></td>
  <td><?php echo "$".number_format($totalAP); ?></td>
  <td><?php echo "$".number_format($totaldia); ?></td>
</tr>
</table>

<?php
echo $mensage;// Regresamos los mensajes generados al cliente
?>
              <div class="col-md-4">
                <a class="btn btn-block btn-danger" <a href="ingreso.php"> Volver Atrás</a>
              </div>
            <?php
ob_end_flush();
?>