<?php
session_start();
require_once "../modelos/Cuentasmedicas.php";

$cuentasmedicas = new Cuentasmedicas();

$idAF=isset($_POST["idAF"])? limpiarCadena($_POST["idAF"]):"";
$codprestadorservicio=isset($_POST["codprestadorservicio"])? limpiarCadena($_POST["codprestadorservicio"]):"";
$razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$tipoidentificacion=isset($_POST["tipoidentificacion"])? limpiarCadena($_POST["tipoidentificacion"]):"";
$numeroidentificacion=isset($_POST["numeroidentificacion"])? limpiarCadena($_POST["numeroidentificacion"]):"";
$numerofactura=isset($_POST["numerofactura"])? limpiarCadena($_POST["numerofactura"]):"";
$fechaexpedicionfactura=isset($_POST["fechaexpedicionfactura"])? limpiarCadena($_POST["fechaexpedicionfactura"]):"";
$fechainiciofactura=isset($_POST["fechainiciofactura"])? limpiarCadena($_POST["fechainiciofactura"]):"";
$fechafinalfactura=isset($_POST["fechafinalfactura"])? limpiarCadena($_POST["fechafinalfactura"]):"";
$codigoentidadadministradora=isset($_POST["codigoentidadadministradora"])? limpiarCadena($_POST["codigoentidadadministradora"]):"";
$nombreentidadadministradora=isset($_POST["nombreentidadadministradora"])? limpiarCadena($_POST["nombreentidadadministradora"]):"";
$numerocontacto=isset($_POST["numerocontacto"])? limpiarCadena($_POST["numerocontacto"]):"";
$plandebeneficios=isset($_POST["plandebeneficios"])? limpiarCadena($_POST["plandebeneficios"]):"";
$numerodepoliza=isset($_POST["numerodepoliza"])? limpiarCadena($_POST["numerodepoliza"]):"";
$valorcopago=isset($_POST["valorcopago"])? limpiarCadena($_POST["valorcopago"]):"";
$valorcomision=isset($_POST["valorcomision"])? limpiarCadena($_POST["valorcomision"]):"";
$valordescuentos=isset($_POST["valordescuentos"])? limpiarCadena($_POST["valordescuentos"]):"";
$valorneto=isset($_POST["valorneto"])? limpiarCadena($_POST["valorneto"]):"";
$fecharadicado=isset($_POST["fecharadicado"])? limpiarCadena($_POST["fecharadicado"]):"";
$glosa=isset($_POST["glosa"])? limpiarCadena($_POST["glosa"]):"";
$valorglosa=isset($_POST["valorglosa"])? limpiarCadena($_POST["valorglosa"]):"";
$devolucion=isset($_POST["devolucion"])? limpiarCadena($_POST["devolucion"]):"";
$notacredito=isset($_POST["notacredito"])? limpiarCadena($_POST["notacredito"]):"";
$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$estadopersistencia=isset($_POST["estadopersistencia"])? limpiarCadena($_POST["estadopersistencia"]):"";
$usuario=$_SESSION['login'];

switch ($_GET["op"]){
	case 'guardaryeditar':
			$rspta=$cuentasmedicas->editar($idAF, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones, $usuario);
			echo $rspta ? "Registro actualizado" : "Registro no se pudo actualizar";
	break;

	case 'desactivar':
		$rspta=$cuentasmedicas->desactivar($idAF);
 		echo $rspta ? "Registro guardado" : "Registro no se puede guardar";
	break;

	case 'activar':
		$rspta=$cuentasmedicas->activar($idAF);
 		echo $rspta ? "Registro activado" : "Registro no se puede activar";
	break;

	case 'mostrar':
		$rspta=$cuentasmedicas->mostrar($idAF);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrarhistorial':
		$rspta=$cuentasmedicas->mostrarhistorial($_GET["factura"]);
 		//Codificar el resultado utilizando json
		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->id_auditoria_cuentasmedicas,
 				"1"=>$reg->accion,
				"2"=>$reg->factura,
				"3"=>$reg->id_af,
				"4"=>$reg->fecha,
				"5"=>$reg->new_glosa,
				"6"=>$reg->old_glosa,
				"7"=>$reg->new_valorglosa,
				"8"=>$reg->old_valorglosa,
				"9"=>$reg->new_devolucion,
				"10"=>$reg->old_devolucion,
				"11"=>$reg->new_notacredito,
				"12"=>$reg->old_notacredito,
				"13"=>$reg->new_observaciones,
				"14"=>$reg->old_observaciones,
				"15"=>$reg->usuario,
				"16"=>$reg->new_estado,
				"17"=>$reg->old_estado,
				"18"=>$reg->new_estadopersistencia,
				"19"=>$reg->old_estadopersistencia,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'buscar':
		$rspta=$cuentasmedicas->buscarFechas($_GET["fechainicio"], $_GET["fechafin"], $_GET["factura"], $_GET["identificacion"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idAF.')"><i class="fa fa-pencil-alt fa-xs"></i></button>
				<button class="btn btn-info" onclick="mostrarhistorial('.$_GET["factura"].')">Historial</i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idAF.')"><i class="fa fa-pencil-alt fa-xs"></i></button>
					<button class="btn btn-info" onclick="mostrarhistorial('.$_GET["factura"].')">Historial</i></button>',
 				"1"=>$reg->idAF,
				"2"=>$reg->codprestadorservicio,
				"3"=>$reg->razonsocial,
				"4"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"5"=>$reg->numerofactura,
				"6"=>$reg->fechaexpedicionfactura,
				"7"=>$reg->fechainiciofactura,
				"8"=>$reg->fechafinalfactura,
				"9"=>$reg->codigoentidadadministradora,
				"10"=>$reg->nombreentidadadministradora,
				"11"=>$reg->numerocontacto,
				"12"=>$reg->plandebeneficios,
				"13"=>$reg->numerodepoliza,
				"14"=>$reg->valorcopago,
				"15"=>$reg->valorcomision,
				"16"=>$reg->valordescuentos,
				"17"=>"$ ".number_format($reg->valorneto),
				"18"=>$reg->fecharadicado,
				"19"=>$reg->estado,
				"20"=>$reg->estadopersistencia,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listar':
		$rspta=$cuentasmedicas->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idAF.')"><i class="fa fa-pencil-alt fa-xs"></i></button>
				<button class="btn btn-info" onclick="mostrarhistorial('.$_GET["factura"].')">Historial</i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idAF.')"><i class="fa fa-pencil-alt fa-xs"></i></button>
					<button class="btn btn-info" onclick="mostrarhistorial('.$_GET["factura"].')">Historial</i></button>',
 				"1"=>$reg->idAF,
				"2"=>$reg->codprestadorservicio,
				"3"=>$reg->razonsocial,
				"4"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"5"=>$reg->numerofactura,
				"6"=>$reg->fechaexpedicionfactura,
				"7"=>$reg->fechainiciofactura,
				"8"=>$reg->fechafinalfactura,
				"9"=>$reg->codigoentidadadministradora,
				"10"=>$reg->nombreentidadadministradora,
				"11"=>$reg->numerocontacto,
				"12"=>$reg->plandebeneficios,
				"13"=>$reg->numerodepoliza,
				"14"=>$reg->valorcopago,
				"15"=>$reg->valorcomision,
				"16"=>$reg->valordescuentos,
				"17"=>"$ ".number_format($reg->valorneto),
				"18"=>$reg->fecharadicado,
				"19"=>$reg->estado,
				"20"=>$reg->estadopersistencia,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'buscarAC':
		$rspta=$cuentasmedicas->buscarAC($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecact('.$reg->idAC.')" class="btn btn-warning" value="('.$reg->idAC.')"><i class="fa fa-pencil">'.$reg->idAC.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechaconsulta,
				"7"=>$reg->numeroautorizacion,
				"8"=>$reg->codigoconsulta,
				"9"=>$reg->finalidadconsulta,
				"10"=>$reg->causaexterna,
				"11"=>$reg->codigodiagnosticoprincipal,
				"12"=>$reg->codigodiagnósticorelacionado1,
				"13"=>$reg->codigodiagnósticorelacionado2,
				"14"=>$reg->codigodiagnósticorelacionad3,
				"15"=>$reg->tipodiagnósticoprincipal,
				"16"=>"$ ".number_format($reg->valorconsulta),
				"17"=>"$ ".number_format($reg->valorcopago),
				"18"=>"$ ".number_format($reg->valorneto),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'updateAC':
		$rspta=$cuentasmedicas->updateAC($_GET['idAF'], $_GET['idAC'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucionc'],  $_GET['notacreditoc'],  $_GET['observacionesc']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecact('.$reg->idAC.')" class="btn btn-warning" value="('.$reg->idAC.')"><i class="fa fa-pencil">'.$reg->idAC.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechaconsulta,
				"7"=>$reg->numeroautorizacion,
				"8"=>$reg->codigoconsulta,
				"9"=>$reg->finalidadconsulta,
				"10"=>$reg->causaexterna,
				"11"=>$reg->codigodiagnosticoprincipal,
				"12"=>$reg->codigodiagnósticorelacionado1,
				"13"=>$reg->codigodiagnósticorelacionado2,
				"14"=>$reg->codigodiagnósticorelacionad3,
				"15"=>$reg->tipodiagnósticoprincipal,
				"16"=>"$ ".number_format($reg->valorconsulta),
				"17"=>"$ ".number_format($reg->valorcopago),
				"18"=>"$ ".number_format($reg->valorneto),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'buscarAP':
		$rspta=$cuentasmedicas->buscarAP($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecpro('.$reg->idAP.')" class="btn btn-warning" value="('.$reg->idAP.')"><i class="fa fa-pencil">'.$reg->idAP.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechaprocedimiento,
				"7"=>$reg->numeroautorizacion,
				"8"=>$reg->codigoprocedimiento,
				"9"=>$reg->ambitorealizacionprocedimiento,
				"10"=>$reg->finalidadprocedimiento,
				"11"=>$reg->personalqueatiende,
				"12"=>$reg->diagnosticoprincipal,
				"13"=>$reg->diagnosticorelacionado,
				"14"=>$reg->complicacion,
				"15"=>$reg->formarealizacionactoquirurgico,
				"16"=>"$ ".number_format($reg->valorprocedimiento),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'updateAP':
		$rspta=$cuentasmedicas->updateAP($_GET['idAF'], $_GET['idAP'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecact('.$reg->idAP.')" class="btn btn-warning" value="('.$reg->idAP.')"><i class="fa fa-pencil">'.$reg->idAP.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechaprocedimiento,
				"7"=>$reg->numeroautorizacion,
				"8"=>$reg->codigoprocedimiento,
				"9"=>$reg->ambitorealizacionprocedimiento,
				"10"=>$reg->finalidadprocedimiento,
				"11"=>$reg->personalqueatiende,
				"12"=>$reg->diagnosticoprincipal,
				"13"=>$reg->diagnosticorelacionado,
				"14"=>$reg->complicacion,
				"15"=>$reg->formarealizacionactoquirurgico,
				"16"=>"$ ".number_format($reg->valorprocedimiento),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'buscarAU':
		$rspta=$cuentasmedicas->buscarAU($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecua('.$reg->idAU.')" class="btn btn-warning" value="('.$reg->idAU.')"><i class="fa fa-pencil">'.$reg->idAU.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechaingresousuario,
				"7"=>$reg->horaingreso,
				"8"=>$reg->numeroautorizacion,
				"9"=>$reg->causaexterna,
				"10"=>$reg->diagnosticosalida,
				"11"=>$reg->diagnosticorelacionadosalida1,
				"12"=>$reg->diagnosticorelacionadosalida2,
				"13"=>$reg->diagnosticorelacionadosalida3,
				"14"=>$reg->destinousuariosalidaobservacion,
				"15"=>$reg->estadosalida,
				"16"=>$reg->causabasicamuerteurgencias,
				"17"=>$reg->fechasalidaobservacion,
				"18"=>$reg->horasalidaobservacion,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'updateAU':
		$rspta=$cuentasmedicas->updateAU($_GET['idAF'], $_GET['idAU'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecua('.$reg->idAU.')" class="btn btn-warning" value="('.$reg->idAU.')"><i class="fa fa-pencil">'.$reg->idAU.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechaingresousuario,
				"7"=>$reg->horaingreso,
				"8"=>$reg->numeroautorizacion,
				"9"=>$reg->causaexterna,
				"10"=>$reg->diagnosticosalida,
				"11"=>$reg->diagnosticorelacionadosalida1,
				"12"=>$reg->diagnosticorelacionadosalida2,
				"13"=>$reg->diagnosticorelacionadosalida3,
				"14"=>$reg->destinousuariosalidaobservacion,
				"15"=>$reg->estadosalida,
				"16"=>$reg->causabasicamuerteurgencias,
				"17"=>$reg->fechasalidaobservacion,
				"18"=>$reg->horasalidaobservacion,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'buscarAH':
		$rspta=$cuentasmedicas->buscarAH($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecuh('.$reg->idAH.')" class="btn btn-warning" value="('.$reg->idAH.')"><i class="fa fa-pencil">'.$reg->idAH.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->viaingresoinstitución,
				"7"=>$reg->fechaingreso,
				"8"=>$reg->horaingreso,
				"9"=>$reg->numeroautorizacion,
				"10"=>$reg->causaexterna,
				"11"=>$reg->diagnosticoprincipalingreso,
				"12"=>$reg->diagnosticoprincipalegreso,
				"13"=>$reg->diagnosticorelacionadoegreso1,
				"14"=>$reg->diagnosticorelacionadoegreso2,
				"15"=>$reg->diagnosticorelacionadoegreso3,
				"16"=>$reg->estadosalida,
				"17"=>$reg->diagnosticocausabasicamuerte,
				"18"=>$reg->fechaegreso,
				"19"=>$reg->horaegreso,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'updateAH':
		$rspta=$cuentasmedicas->updateAH($_GET['idAF'], $_GET['idAH'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecuh('.$reg->idAH.')" class="btn btn-warning" value="('.$reg->idAH.')"><i class="fa fa-pencil">'.$reg->idAH.'</i></button>',
				"1"=>$reg->estado,
 				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->viaingresoinstitución,
				"7"=>$reg->fechaingreso,
				"8"=>$reg->horaingreso,
				"9"=>$reg->numeroautorizacion,
				"10"=>$reg->causaexterna,
				"11"=>$reg->diagnosticoprincipalingreso,
				"12"=>$reg->diagnosticoprincipalegreso,
				"13"=>$reg->diagnosticorelacionadoegreso1,
				"14"=>$reg->diagnosticorelacionadoegreso2,
				"15"=>$reg->diagnosticorelacionadoegreso3,
				"16"=>$reg->estadosalida,
				"17"=>$reg->diagnosticocausabasicamuerte,
				"18"=>$reg->fechaegreso,
				"19"=>$reg->horaegreso,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'buscarAN':
		$rspta=$cuentasmedicas->buscarAN($_GET['idAF']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>'<button type="button" onclick="selecun('.$reg->idAN.')" class="btn btn-warning" value="('.$reg->idAN.')"><i class="fa fa-pencil">'.$reg->idAN.'</i></button>',
				"1"=>$reg->estado,
				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacionmadre,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechanacimiento,
				"7"=>$reg->edadgestacional,
				"8"=>$reg->controlprenatal,
				"9"=>$reg->sexo,
				"10"=>$reg->peso,
				"11"=>$reg->diagnosticoreciennacido,
				"12"=>$reg->causabasicamuerte,
				"13"=>$reg->fechamuerte,
				"14"=>$reg->hora,
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'updateAN':
		$rspta=$cuentasmedicas->updateAN($_GET['idAF'], $_GET['idAN'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>'<button type="button" onclick="selecun('.$reg->idAN.')" class="btn btn-warning" value="('.$reg->idAN.')"><i class="fa fa-pencil">'.$reg->idAN.'</i></button>',
				"1"=>$reg->estado,
				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacionmadre,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->fechanacimiento,
				"7"=>$reg->edadgestacional,
				"8"=>$reg->controlprenatal,
				"9"=>$reg->sexo,
				"10"=>$reg->peso,
				"11"=>$reg->diagnosticoreciennacido,
				"12"=>$reg->causabasicamuerte,
				"13"=>$reg->fechamuerte,
				"14"=>$reg->hora,
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'buscarAM':
		$rspta=$cuentasmedicas->buscarAM($_GET['idAF']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>'<button type="button" onclick="selecum('.$reg->idAM.')" class="btn btn-warning" value="('.$reg->idAM.')"><i class="fa fa-pencil">'.$reg->idAM.'</i></button>',
				"1"=>$reg->estado,
				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->codigomedicamento,
				"8"=>$reg->tipomedicamento,
				"9"=>$reg->nombregenericomedicamento,
				"10"=>$reg->formafarmaceutica,
				"11"=>$reg->concentracionmedicamento,
				"12"=>$reg->unidadmedidamedicamento,
				"13"=>$reg->numerounidades,
				"14"=>"$ ".number_format($reg->valorunitariomedicamento),
				"15"=>"$ ".number_format($reg->valortotalmedicamento),
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'updateAM':
		$rspta=$cuentasmedicas->updateAM($_GET['idAF'], $_GET['idAM'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>'<button type="button" onclick="selecum('.$reg->idAM.')" class="btn btn-warning" value="('.$reg->idAM.')"><i class="fa fa-pencil">'.$reg->idAM.'</i></button>',
				"1"=>$reg->estado,
				"2"=>$reg->numerofactura,
				"3"=>$reg->codigoprestadorserviciossalud,
				"4"=>$reg->tipoidentificacion,
				"5"=>$reg->numeroidentificacion,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->codigomedicamento,
				"8"=>$reg->tipomedicamento,
				"9"=>$reg->nombregenericomedicamento,
				"10"=>$reg->formafarmaceutica,
				"11"=>$reg->concentracionmedicamento,
				"12"=>$reg->unidadmedidamedicamento,
				"13"=>$reg->numerounidades,
				"14"=>"$ ".number_format($reg->valorunitariomedicamento),
				"15"=>"$ ".number_format($reg->valortotalmedicamento),
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'buscarUS':
		$rspta=$cuentasmedicas->buscarUS($_GET['idAF']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>'<button type="button" onclick="selecum('.$reg->idUS.')" class="btn btn-warning" value="('.$reg->idUS.')"><i class="fa fa-pencil">'.$reg->idUS.'</i></button>',
				"1"=>$reg->estado,
				"2"=>$reg->tipoidentificacion,
				"3"=>$reg->numeroidentificacion,
				"4"=>$reg->codigoentidadadministradora,
				"5"=>$reg->tipousuario,
				"6"=>$reg->primerapellido,
				"7"=>$reg->segundoapellido,
				"8"=>$reg->primernombre,
				"9"=>$reg->segundonombre,
				"10"=>$reg->edad,
				"11"=>$reg->unidadmedidadedad,
				"12"=>$reg->sexo,
				"13"=>$reg->codigodepartamento,
				"14"=>$reg->codigomunicipio,
				"15"=>$reg->zonaresidencia,
				"16"=>$reg->glosa,
				"17"=>$reg->devolucion,
				"18"=>$reg->notacredito,
				"19"=>$reg->observaciones,
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'updateUS':
		$rspta=$cuentasmedicas->updateUS($_GET['idAF'], $_GET['idUS'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>'<button type="button" onclick="selecum('.$reg->idUS.')" class="btn btn-warning" value="('.$reg->idUS.')"><i class="fa fa-pencil">'.$reg->idUS.'</i></button>',
				"1"=>$reg->estado,
				"2"=>$reg->tipoidentificacion,
				"3"=>$reg->numeroidentificacion,
				"4"=>$reg->codigoentidadadministradora,
				"5"=>$reg->tipousuario,
				"6"=>$reg->primerapellido,
				"7"=>$reg->segundoapellido,
				"8"=>$reg->primernombre,
				"9"=>$reg->segundonombre,
				"10"=>$reg->edad,
				"11"=>$reg->unidadmedidadedad,
				"12"=>$reg->sexo,
				"13"=>$reg->codigodepartamento,
				"14"=>$reg->codigomunicipio,
				"15"=>$reg->zonaresidencia,
				"16"=>$reg->glosa,
				"17"=>$reg->devolucion,
				"18"=>$reg->notacredito,
				"19"=>$reg->observaciones,
				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);
	break;

	case 'buscarAT':
		$rspta=$cuentasmedicas->buscarAT($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecact('.$reg->idAT.')" class="btn btn-warning" value="('.$reg->idAT.')"><i class="fa fa-pencil">'.$reg->idAT.'</i></button>',
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.''.$reg->numeroidentificacion,
				"4"=>$reg->numeroautorizacion,
				"5"=>$reg->tiposervicio,
				"6"=>$reg->codigoservicio,
				"7"=>$reg->nombreservicio,
				"8"=>number_format($reg->cantidad),
				"9"=>"$".number_format($reg->valorunitariomaterialinsumo),
				"10"=>"$".number_format($reg->valortotalmaterial),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'updateAT':
		$rspta=$cuentasmedicas->updateAT($_GET['idAF'], $_GET['idAT'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devoluciont'],  $_GET['notacreditot'],  $_GET['observacionest']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button type="button" onclick="selecact('.$reg->idAT.')" class="btn btn-warning" value="('.$reg->idAT.')"><i class="fa fa-pencil">'.$reg->idAT.'</i></button>',
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.''.$reg->numeroidentificacion,
				"4"=>$reg->numeroautorizacion,
				"5"=>$reg->tiposervicio,
				"6"=>$reg->codigoservicio,
				"7"=>$reg->nombreservicio,
				"8"=>number_format($reg->cantidad),
				"9"=>"$".number_format($reg->valorunitariomaterialinsumo),
				"10"=>"$".number_format($reg->valortotalmaterial),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

	case 'updateAF':
		$rspta=$cuentasmedicas->updateAP($_GET['idAF'], $_GET['valorglosa'], $_GET['glosa'],  $_GET['devolucion'],  $_GET['notacredito'],  $_GET['observaciones']);
		echo "Registro actualizado";
	break;

	case 'salir':
		//Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
	break;
}
?>
