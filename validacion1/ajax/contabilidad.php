<?php
session_start();
require_once "../modelos/Contabilidad.php";

$contabilidad = new Contabilidad();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$contabilidad->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAF,
				"1"=>$reg->codprestadorservicio,
				"2"=>$reg->razonsocial,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->numerofactura,
				"5"=>$reg->fechaexpedicionfactura,
				"6"=>$reg->fechainiciofactura,
				"7"=>$reg->fechafinalfactura,
				"8"=>$reg->codigoentidadadministradora,
				"9"=>$reg->nombreentidadadministradora,
				"10"=>$reg->numerocontacto,
				"11"=>$reg->plandebeneficios,
				"12"=>$reg->numerodepoliza,
				"13"=>"$".number_format($reg->valorcopago),
				"14"=>"$".number_format($reg->valorcomision),
				"15"=>"$".number_format($reg->valordescuentos),
				"16"=>"$".number_format($reg->valorneto),
				"17"=>$reg->fecharadicado,
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
		$rspta=$contabilidad->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAF,
				"1"=>$reg->codprestadorservicio,
				"2"=>$reg->razonsocial,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->numerofactura,
				"5"=>$reg->fechaexpedicionfactura,
				"6"=>$reg->fechainiciofactura,
				"7"=>$reg->fechafinalfactura,
				"8"=>$reg->codigoentidadadministradora,
				"9"=>$reg->nombreentidadadministradora,
				"10"=>$reg->numerocontacto,
				"11"=>$reg->plandebeneficios,
				"12"=>$reg->numerodepoliza,
				"13"=>"$".number_format($reg->valorcopago),
				"14"=>"$".number_format($reg->valorcomision),
				"15"=>"$".number_format($reg->valordescuentos),
				"16"=>"$".number_format($reg->valorneto),
				"17"=>$reg->fecharadicado,
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
