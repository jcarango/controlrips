<?php
session_start();
require_once "../modelos/Cuadredia.php";

$cuadredia = new Cuadredia();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$cuadredia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>"$".number_format($reg->totalAF),
				"1"=>"$".number_format($reg->totalAT),
				"2"=>"$".number_format($reg->totalAM),
				"3"=>"$".number_format($reg->totalAC),
				"4"=>"$".number_format($reg->totalAP),
				"5"=>"$".number_format($reg->diferencia),
				"6"=>$reg->usuario,
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
