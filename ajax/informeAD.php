<?php
session_start();
require_once "../modelos/InformeAD.php";

$informeAD = new InformeAD();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAD->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAD,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codprestadorservicio,
				"3"=>$reg->codigodeconcepto,
				"4"=>$reg->cantidad,
				"5"=>"$".number_format($reg->valorunitario),
				"6"=>"$".number_format($reg->valortotal),
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
		$rspta=$informeAD->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAD,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codprestadorservicio,
				"3"=>$reg->codigodeconcepto,
				"4"=>$reg->cantidad,
				"5"=>"$".number_format($reg->valorunitario),
				"6"=>"$".number_format($reg->valortotal),
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
