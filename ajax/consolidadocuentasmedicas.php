<?php
session_start();
require_once "../modelos/Consolidadocuentasmedicas.php";

$consolidadocuentasmedicas = new Consolidadocuentasmedicas();

switch ($_GET["op"]){

	case 'mostrar':
		$rspta=$consolidadocuentasmedicas->mostrar($idAF);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'buscar':
		$rspta=$consolidadocuentasmedicas->buscarFechas($_GET["factura"], $_GET["identificacion"], $_GET["fechainicio"],$_GET["fechafin"],$_GET["usuario"]);
        $rsptaT=$consolidadocuentasmedicas->buscarFechasTotalF($_GET["factura"], $_GET["identificacion"], $_GET["fechainicio"],$_GET["fechafin"],$_GET["usuario"]);

        //Vamos a declarar un array
 		$data= Array();
        $_SESSION['total'] = 0;
 		$total = 0;
 		$totalglosas = 0;

        while ($reg2=$rsptaT->fetch_object()){

            $totalglosas += $reg2->total;
        }

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAF,
				"1"=>$reg->codprestadorservicio,
				"2"=>$reg->razonsocial,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->numerofactura,
				"5"=>$reg->fechaexpedicionfactura,
				"6"=>$reg->fechainiciofactura,
				"7"=>$reg->fechafinalfactura,
				"8"=>$reg->codigoentidadadministradora,
				"9"=>$reg->nombreentidadadministradora,
				"10"=>$reg->numerocontacto,
				"11"=>$reg->plandebeneficios,
				"12"=>$reg->numerodepoliza,
				"13"=>$reg->valorcopago,
				"14"=>$reg->valorcomision,
				"15"=>$reg->valordescuentos,
				"16"=>"$ ".number_format($reg->valorneto),
				"17"=>$reg->fecharadicado,
				"18"=>$reg->glosa,
				"19"=>$reg->valorglosa,
				"20"=>$reg->devolucion,
				"21"=>$reg->notacredito,
				"22"=>$reg->observaciones,
				"23"=>$reg->estado,
				"24"=>$reg->estadopersistencia,
 				);
 			$total += $reg->valorneto;
 		}
 		//$_SESSION['total'] =  money_format("%.2n", $total + $totalglosas);
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalFact"=>$total - $totalglosas,
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data
		);
 		echo json_encode($results);

	break;

	case 'buscarAC':
		$rspta=$consolidadocuentasmedicas->buscarAC($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->estado,
 				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->fechaconsulta,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->codigoconsulta,
				"8"=>$reg->finalidadconsulta,
				"9"=>$reg->causaexterna,
				"10"=>$reg->codigodiagnosticoprincipal,
				"11"=>$reg->codigodiagnósticorelacionado1,
				"12"=>$reg->codigodiagnósticorelacionado2,
				"13"=>$reg->codigodiagnósticorelacionad3,
				"14"=>$reg->tipodiagnósticoprincipal,
				"15"=>"$ ".number_format($reg->valorconsulta),
				"16"=>"$ ".number_format($reg->valorcopago),
				"17"=>"$ ".number_format($reg->valorneto),
				"18"=>$reg->glosa,
				"19"=>$reg->valorglosa,
				"20"=>$reg->devolucion,
				"21"=>$reg->notacredito,
				"22"=>$reg->observaciones,
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
		$rspta=$consolidadocuentasmedicas->buscarAP($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->estado,
 				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->fechaprocedimiento,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->codigoprocedimiento,
				"8"=>$reg->ambitorealizacionprocedimiento,
				"9"=>$reg->finalidadprocedimiento,
				"10"=>$reg->personalqueatiende,
				"11"=>$reg->diagnosticoprincipal,
				"12"=>$reg->diagnosticorelacionado,
				"13"=>$reg->complicacion,
				"14"=>$reg->formarealizacionactoquirurgico,
				"15"=>"$ ".number_format($reg->valorprocedimiento),
				"16"=>$reg->glosa,
				"17"=>"$ ".number_format($reg->valorglosa),
				"18"=>"$ ".number_format($reg->devolucion),
				"19"=>"$ ".number_format($reg->notacredito),
				"20"=>$reg->observaciones,
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
		$rspta=$consolidadocuentasmedicas->buscarAU($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->estado,
 				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->fechaingresousuario,
				"6"=>$reg->horaingreso,
				"7"=>$reg->numeroautorizacion,
				"8"=>$reg->causaexterna,
				"9"=>$reg->diagnosticosalida,
				"10"=>$reg->diagnosticorelacionadosalida1,
				"11"=>$reg->diagnosticorelacionadosalida2,
				"12"=>$reg->diagnosticorelacionadosalida3,
				"13"=>$reg->destinousuariosalidaobservacion,
				"14"=>$reg->estadosalida,
				"15"=>$reg->causabasicamuerteurgencias,
				"16"=>$reg->fechasalidaobservacion,
				"17"=>$reg->horasalidaobservacion,
				"18"=>$reg->glosa,
				"19"=>"$ ".number_format($reg->valorglosa),
				"20"=>"$ ".number_format($reg->devolucion),
				"21"=>"$ ".number_format($reg->notacredito),
				"22"=>$reg->observaciones,
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
		$rspta=$consolidadocuentasmedicas->buscarAH($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->estado,
 				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->viaingresoinstitución,
				"6"=>$reg->fechaingreso,
				"7"=>$reg->horaingreso,
				"8"=>$reg->numeroautorizacion,
				"9"=>$reg->causaexterna,
				"10"=>$reg->diagnosticoprincipalingreso,
				"11"=>$reg->diagnosticoprincipalegreso,
				"12"=>$reg->diagnosticorelacionadoegreso1,
				"13"=>$reg->diagnosticorelacionadoegreso2,
				"14"=>$reg->diagnosticorelacionadoegreso3,
				"15"=>$reg->estadosalida,
				"16"=>$reg->diagnosticocausabasicamuerte,
				"17"=>$reg->fechaegreso,
				"18"=>$reg->horaegreso,
				"19"=>$reg->glosa,
				"20"=>"$ ".number_format($reg->valorglosa),
				"21"=>"$ ".number_format($reg->devolucion),
				"22"=>"$ ".number_format($reg->notacredito),
				"23"=>$reg->observaciones,
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
		$rspta=$consolidadocuentasmedicas->buscarAN($_GET['idAF']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>$reg->estado,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacionmadre,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->fechanacimiento,
				"6"=>$reg->edadgestacional,
				"7"=>$reg->controlprenatal,
				"8"=>$reg->sexo,
				"9"=>$reg->peso,
				"10"=>$reg->diagnosticoreciennacido,
				"11"=>$reg->causabasicamuerte,
				"12"=>$reg->fechamuerte,
				"13"=>$reg->hora,
				"14"=>$reg->glosa,
				"15"=>"$ ".number_format($reg->valorglosa),
				"16"=>"$ ".number_format($reg->devolucion),
				"17"=>"$ ".number_format($reg->notacredito),
				"18"=>$reg->observaciones,
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
		$rspta=$consolidadocuentasmedicas->buscarAM($_GET['idAF']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>$reg->estado,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->numeroautorizacion,
				"6"=>$reg->codigomedicamento,
				"7"=>$reg->tipomedicamento,
				"8"=>$reg->nombregenericomedicamento,
				"9"=>$reg->formafarmaceutica,
				"10"=>$reg->concentracionmedicamento,
				"11"=>$reg->unidadmedidamedicamento,
				"12"=>$reg->numerounidades,
				"13"=>"$ ".number_format($reg->valorunitariomedicamento),
				"14"=>"$ ".number_format($reg->valortotalmedicamento),
				"15"=>$reg->glosa,
				"16"=>"$ ".number_format($reg->valorglosa),
				"17"=>"$ ".number_format($reg->devolucion),
				"18"=>"$ ".number_format($reg->notacredito),
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

	case 'buscarUS':
		$rspta=$consolidadocuentasmedicas->buscarUS($_GET['idAF']);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"0"=>$reg->estado,
				"1"=>$reg->tipoidentificacion,
				"2"=>$reg->numeroidentificacion,
				"3"=>$reg->codigoentidadadministradora,
				"4"=>$reg->tipousuario,
				"5"=>$reg->primerapellido,
				"6"=>$reg->segundoapellido,
				"7"=>$reg->primernombre,
				"8"=>$reg->segundonombre,
				"9"=>$reg->edad,
				"10"=>$reg->unidadmedidadedad,
				"11"=>$reg->sexo,
				"12"=>$reg->codigodepartamento,
				"13"=>$reg->codigomunicipio,
				"14"=>$reg->zonaresidencia,
				"15"=>$reg->glosa,
				"16"=>$reg->devolucion,
				"17"=>$reg->notacredito,
				"18"=>$reg->observaciones,
				"19"=>$reg->glosa,
				"20"=>"$ ".number_format($reg->valorglosa),
				"21"=>"$ ".number_format($reg->devolucion),
				"22"=>"$ ".number_format($reg->notacredito),
				"23"=>$reg->observaciones,
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
		$rspta=$consolidadocuentasmedicas->buscarAT($_GET['idAF']);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->numerofactura,
				"1"=>$reg->codigoprestadorserviciossalud,
				"2"=>$reg->tipoidentificacion.''.$reg->numeroidentificacion,
				"3"=>$reg->numeroautorizacion,
				"4"=>$reg->tiposervicio,
				"5"=>$reg->codigoservicio,
				"6"=>$reg->nombreservicio,
				"7"=>number_format($reg->cantidad),
				"8"=>"$".number_format($reg->valorunitariomaterialinsumo),
				"9"=>"$".number_format($reg->valortotalmaterial),
				"10"=>$reg->glosa,
				"11"=>"$ ".number_format($reg->valorglosa),
				"12"=>"$ ".number_format($reg->devolucion),
				"13"=>"$ ".number_format($reg->notacredito),
				"14"=>$reg->observaciones,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
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
