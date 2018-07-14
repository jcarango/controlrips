<?php
session_start();
require_once "../modelos/InformeAU.php";

$informeAU = new InformeAU();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAU->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAU,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechaingresousuario.':'.$reg->horaingreso,
				"5"=>$reg->numeroautorizacion,
				"6"=>$reg->causaexterna,
				"7"=>$reg->diagnosticosalida,
				"8"=>$reg->diagnosticorelacionadosalida1,
				"9"=>$reg->diagnosticorelacionadosalida2,
				"10"=>$reg->diagnosticorelacionadosalida3,
				"11"=>$reg->destinousuariosalidaobservacion,
				"12"=>$reg->estadosalida,
				"13"=>$reg->causabasicamuerteurgencias,
				"14"=>$reg->fechasalidaobservacion.':'.$reg->horasalidaobservacion,
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
		$rspta=$informeAU->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAU,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechaingresousuario.':'.$reg->horaingreso,
				"5"=>$reg->numeroautorizacion,
				"6"=>$reg->causaexterna,
				"7"=>$reg->diagnosticosalida,
				"8"=>$reg->diagnosticorelacionadosalida1,
				"9"=>$reg->diagnosticorelacionadosalida2,
				"10"=>$reg->diagnosticorelacionadosalida3,
				"11"=>$reg->destinousuariosalidaobservacion,
				"12"=>$reg->estadosalida,
				"13"=>$reg->causabasicamuerteurgencias,
				"14"=>$reg->fechasalidaobservacion.':'.$reg->horasalidaobservacion,
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
