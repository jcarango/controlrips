<?php
session_start();
require_once "../modelos/Archivos.php";

$archivos = new Archivos();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$archivos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array( 
 				"0"=>$reg->idarchivo,
				"1"=>$reg->nombre,
				"2"=>$reg->fecha,
				"3"=>$reg->usuario,
				"4"=>"<a href='../files/rips/".$reg->nombre."' download=".$reg->nombre." target=_blank class='btn btn-success'><i class='fa fa-cloud-download-alt fa-xs'></i></a>",
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
		$rspta=$archivos->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idarchivo,
				"1"=>$reg->nombre,
				"2"=>$reg->fecha,
				"3"=>$reg->usuario,
				"4"=>"<a href='../files/rips/".$reg->nombre."' download=".$reg->nombre." target=_blank>Bajar</a>",
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
