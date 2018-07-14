<?php
session_start();
require_once "../modelos/InformeCT.php";

$informeCT = new InformeCT();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeCT->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idCT,
				"1"=>$reg->fecha,
				"2"=>$reg->usuario,
				"3"=>$reg->codprestadorservicio,
				"4"=>$reg->fecharemision,
				"5"=>$reg->codarchivo,
				"6"=>number_format($reg->totalregistros),
				"7"=>$reg->nomarchivo,
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
		$rspta=$informeCT->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idCT,
				"1"=>$reg->fecha,
				"2"=>$reg->usuario,
				"3"=>$reg->codprestadorservicio,
				"4"=>$reg->fecharemision,
				"5"=>$reg->codarchivo,
				"6"=>number_format($reg->totalregistros),
				"7"=>$reg->nomarchivo,
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
