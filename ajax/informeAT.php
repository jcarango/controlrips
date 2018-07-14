<?php
session_start();
require_once "../modelos/InformeAT.php";

$informeAT = new InformeAT();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAT->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAT,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.''.$reg->numeroidentificacion,
				"4"=>$reg->numeroautorizacion,
				"5"=>$reg->tiposervicio,
				"6"=>$reg->codigoservicio,
				"7"=>$reg->nombreservicio,
				"8"=>number_format($reg->cantidad),
				"9"=>"$".number_format($reg->valorunitariomaterialinsumo),
				"10"=>"$".number_format($reg->valortotalmaterial),
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
		$rspta=$informeAT->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAT,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.''.$reg->numeroidentificacion,
				"4"=>$reg->numeroautorizacion,
				"5"=>$reg->tiposervicio,
				"6"=>$reg->codigoservicio,
				"7"=>$reg->nombreservicio,
				"8"=>"$".number_format($reg->cantidad),
				"9"=>"$".number_format($reg->valorunitariomaterialinsumo),
				"10"=>"$".number_format($reg->valortotalmaterial),
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
