<?php
session_start();
require_once "../modelos/InformeAC.php";

$informeAC = new InformeAC();

switch ($_GET["op"]){

	case 'listar':
		$rspta=$informeAC->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAC,
				"1"=>$reg->numerofactura ,
				"2"=>$reg->codigoprestadorserviciossalud ,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechaconsulta ,
				"5"=>$reg->numeroautorizacion,
				"6"=>$reg->codigoconsulta,
				"7"=>$reg->finalidadconsulta ,
				"8"=>$reg->causaexterna,
				"9"=>$reg->codigodiagnosticoprincipal,
				"10"=>$reg->codigodiagnósticorelacionado1 ,
				"11"=>$reg->codigodiagnósticorelacionado2 ,
				"12"=>$reg->codigodiagnósticorelacionad3,
				"13"=>$reg->tipodiagnósticoprincipal,
				"14"=>"$".number_format($reg->valorconsulta),
				"15"=>"$".number_format($reg->valorcopago),
				"16"=>"$".number_format($reg->valorneto),
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
		$rspta=$informeAC->buscarFechas($_GET["fechainicio"], $_GET["fechafin"]);
 		//Vamos a declarar un array
 		$data= Array();

		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idAC,
				"1"=>$reg->numerofactura ,
				"2"=>$reg->codigoprestadorserviciossalud ,
				"3"=>$reg->tipoidentificacion.' '.$reg->numeroidentificacion,
				"4"=>$reg->fechaconsulta ,
				"5"=>$reg->numeroautorizacion,
				"6"=>$reg->codigoconsulta,
				"7"=>$reg->finalidadconsulta ,
				"8"=>$reg->causaexterna,
				"9"=>$reg->codigodiagnosticoprincipal,
				"10"=>$reg->codigodiagnósticorelacionado1 ,
				"11"=>$reg->codigodiagnósticorelacionado2 ,
				"12"=>$reg->codigodiagnósticorelacionad3,
				"13"=>$reg->tipodiagnósticoprincipal,
				"14"=>"$".number_format($reg->valorconsulta),
				"15"=>"$".number_format($reg->valorcopago),
				"16"=>"$".number_format($reg->valorneto),
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
