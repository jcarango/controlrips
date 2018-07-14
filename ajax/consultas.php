<?php
session_start(); 
require_once "../modelos/Consultas.php";

$consultas = new Consultas();

switch ($_GET["op"]){
	
	case 'listar':
		$rspta=$consultas->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-danger" onclick="eliminar('.$reg->idAF.')"><i class="fa fa-trash fa-xs"></i></button>',
 				"1"=>$reg->idAF,
 				"2"=>$reg->razonsocial,
 				"3"=>$reg->numeroidentificacion,
 				"4"=>$reg->numerofactura,
 				"5"=>"$".number_format($reg->valorneto),
 				"6"=>$reg->fecharadicado,
 				"7"=>$reg->usuariocarga,
 				"8"=>$reg->usuario,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'eliminar':
		$rspta=$consultas->eliminar($_POST["idAF"]);
 		echo $rspta ? "Factura eliminada" : "Factura no se puede eliminar";
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