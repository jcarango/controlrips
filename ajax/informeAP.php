<?php
session_start();
require_once "../modelos/InformeAP.php";

$informeAP = new InformeAP();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAP->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAP,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechaprocedimiento,
				"5"=>$reg->numeroautorizacion,
				"6"=>$reg->codigoprocedimiento,
				"7"=>$reg->ambitorealizaciónprocedimiento,
				"8"=>$reg->finalidadprocedimiento,
				"9"=>$reg->personalqueatiende,
				"10"=>$reg->diagnosticoprincipal,
				"11"=>$reg->diagnosticorelacionado,
				"12"=>$reg->complicacion,
				"13"=>$reg->formarealizacionactoquirurgico,
				"14"=>"$".number_format($reg->valorprocedimiento),
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
		$rspta=$informeAP->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAP,
				"1"=>$reg->numerofactura,
				"2"=>$reg->codigoprestadorserviciossalud,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->fechaprocedimiento,
				"6"=>$reg->numeroautorizacion,
				"7"=>$reg->codigoprocedimiento,
				"8"=>$reg->ambitorealizaciónprocedimiento,
				"9"=>$reg->finalidadprocedimiento,
				"10"=>$reg->personalqueatiende,
				"11"=>$reg->diagnosticoprincipal,
				"12"=>$reg->diagnosticorelacionado,
				"13"=>$reg->complicacion,
				"14"=>$reg->formarealizacionactoquirurgico,
				"15"=>"$".number_format($reg->valorprocedimiento),
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
