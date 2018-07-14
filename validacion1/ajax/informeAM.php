<?php
session_start();
require_once "../modelos/InformeAM.php";

$informeAM = new InformeAM();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAM->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAM,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->numeroautorizacion,
				"5"=>$reg->codigomedicamento,
				"6"=>$reg->tipomedicamento,
				"7"=>$reg->nombregenericomedicamento,
				"8"=>$reg->formafarmaceutica,
				"9"=>$reg->concentracionmedicamento,
				"10"=>$reg->unidadmedidamedicamento,
				"11"=>$reg->numerounidades,
				"12"=>"$".number_format($reg->valorunitariomedicamento),
				"13"=>"$".number_format($reg->valortotalmedicamento),
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
		$rspta=$informeAM->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAM,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->numeroautorizacion,
				"5"=>$reg->codigomedicamento,
				"6"=>$reg->tipomedicamento,
				"7"=>$reg->nombregenericomedicamento,
				"8"=>$reg->formafarmaceutica,
				"9"=>$reg->concentracionmedicamento,
				"10"=>$reg->unidadmedidamedicamento,
				"11"=>$reg->numerounidades,
				"12"=>"$".number_format($reg->valorunitariomedicamento),
				"13"=>"$".number_format($reg->valortotalmedicamento),
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
