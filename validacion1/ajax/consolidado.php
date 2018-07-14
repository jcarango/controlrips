<?php
session_start();
require_once "../modelos/Consolidado.php";

$consolidado = new Consolidado();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$consolidado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->codprestadorservicio,
				"1"=>$reg->razonsocial,
				"2"=>$reg->numeroidentificacion,
				"3"=>"$".number_format($reg->valorneto),
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
