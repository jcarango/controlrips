<?php
session_start();
require_once "../modelos/InformeAH.php";

$informeAH = new InformeAH();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAH->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAH,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->viaingresoinstitución,
				"5"=>$reg->fechaingreso.':'.$reg->horaingreso,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->causaexterna,
				"8"=>$reg->diagnosticoprincipalingreso,
				"9"=>$reg->diagnosticoprincipalegreso,
				"10"=>$reg->diagnosticorelacionadoegreso1,
				"11"=>$reg->diagnosticorelacionadoegreso2,
				"12"=>$reg->diagnosticorelacionadoegreso3,
				"13"=>$reg->estadosalida,
				"14"=>$reg->diagnosticocausabasicamuerte,
				"15"=>$reg->fechaegreso.':'.$reg->horaegreso,
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
		$rspta=$informeAH->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAH,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->viaingresoinstitución,
				"5"=>$reg->fechaingreso.':'.$reg->horaingreso,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->causaexterna,
				"8"=>$reg->diagnosticoprincipalingreso,
				"9"=>$reg->diagnosticoprincipalegreso,
				"10"=>$reg->diagnosticorelacionadoegreso1,
				"11"=>$reg->diagnosticorelacionadoegreso2,
				"12"=>$reg->diagnosticorelacionadoegreso3,
				"13"=>$reg->estadosalida,
				"14"=>$reg->diagnosticocausabasicamuerte,
				"15"=>$reg->fechaegreso.':'.$reg->horaegreso,
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
