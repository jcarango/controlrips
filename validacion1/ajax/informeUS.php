<?php
session_start();
require_once "../modelos/InformeUS.php";

$informeUS = new InformeUS();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeUS->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idUS,
				"1"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"2"=>$reg->codigoentidadadministradora,
				"3"=>$reg->tipousuario,
				"4"=>$reg->primerapellido,
				"5"=>$reg->segundoapellido,
				"6"=>$reg->primernombre,
				"7"=>$reg->segundonombre,
				"8"=>$reg->edad,
				"9"=>$reg->unidadmedidadedad,
				"10"=>$reg->sexo,
				"11"=>$reg->codigodepartamento,
				"12"=>$reg->codigomunicipio,
				"13"=>$reg->zonaresidencia,
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
		$rspta=$informeUS->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idUS,
				"1"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"2"=>$reg->codigoentidadadministradora,
				"3"=>$reg->tipousuario,
				"4"=>$reg->primerapellido,
				"5"=>$reg->segundoapellido,
				"6"=>$reg->primernombre,
				"7"=>$reg->segundonombre,
				"8"=>$reg->edad,
				"9"=>$reg->unidadmedidadedad,
				"10"=>$reg->sexo,
				"11"=>$reg->codigodepartamento,
				"12"=>$reg->codigomunicipio,
				"13"=>$reg->zonaresidencia,
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
