<?php
session_start();
require_once "../modelos/InformeAN.php";

$informeAN = new InformeAN();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAN->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAN,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacionmadre.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechanacimiento,
				"5"=>$reg->edadgestacional,
				"6"=>$reg->controlprenatal,
				"7"=>$reg->sexo,
				"8"=>$reg->peso,
				"9"=>$reg->diagnosticoreciennacido,
				"10"=>$reg->causabasicamuerte,
				"11"=>$reg->fechamuerte.':'.$reg->hora,
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
		$rspta=$informeAN->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAN,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacionmadre.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechanacimiento,
				"5"=>$reg->edadgestacional,
				"6"=>$reg->controlprenatal,
				"7"=>$reg->sexo,
				"8"=>$reg->peso,
				"9"=>$reg->diagnosticoreciennacido,
				"10"=>$reg->causabasicamuerte,
				"11"=>$reg->fechamuerte.':'.$reg->hora,
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
