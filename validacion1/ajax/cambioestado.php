<?php
session_start();
require_once "../modelos/Cambioestado.php";

$cambioestado = new Cambioestado();

$idAF=isset($_POST["idAF"])? limpiarCadena($_POST["idAF"]):"";
$codprestadorservicio=isset($_POST["codprestadorservicio"])? limpiarCadena($_POST["codprestadorservicio"]):"";
$razonsocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$tipoidentificacion=isset($_POST["tipoidentificacion"])? limpiarCadena($_POST["tipoidentificacion"]):"";
$numeroidentificacion=isset($_POST["numeroidentificacion"])? limpiarCadena($_POST["numeroidentificacion"]):"";
$numerofactura=isset($_POST["numerofactura"])? limpiarCadena($_POST["numerofactura"]):"";
$fechaexpedicionfactura=isset($_POST["fechaexpedicionfactura"])? limpiarCadena($_POST["fechaexpedicionfactura"]):"";
$fechainiciofactura=isset($_POST["fechainiciofactura"])? limpiarCadena($_POST["fechainiciofactura"]):"";
$fechafinalfactura=isset($_POST["fechafinalfactura"])? limpiarCadena($_POST["fechafinalfactura"]):"";
$codigoentidadadministradora=isset($_POST["codigoentidadadministradora"])? limpiarCadena($_POST["codigoentidadadministradora"]):"";
$nombreentidadadministradora=isset($_POST["nombreentidadadministradora"])? limpiarCadena($_POST["nombreentidadadministradora"]):"";
$numerocontacto=isset($_POST["numerocontacto"])? limpiarCadena($_POST["numerocontacto"]):"";
$plandebeneficios=isset($_POST["plandebeneficios"])? limpiarCadena($_POST["plandebeneficios"]):"";
$numerodepoliza=isset($_POST["numerodepoliza"])? limpiarCadena($_POST["numerodepoliza"]):"";
$valorcopago=isset($_POST["valorcopago"])? limpiarCadena($_POST["valorcopago"]):"";
$valorcomision=isset($_POST["valorcomision"])? limpiarCadena($_POST["valorcomision"]):"";
$valordescuentos=isset($_POST["valordescuentos"])? limpiarCadena($_POST["valordescuentos"]):"";
$valorneto=isset($_POST["valorneto"])? limpiarCadena($_POST["valorneto"]):"";
//$fecharadicado=isset($_POST["fecharadicado"])? limpiarCadena($_POST["fecharadicado"]):"";
//$glosa=isset($_POST["glosa"])? limpiarCadena($_POST["glosa"]):"";
//$valorglosa=isset($_POST["valorglosa"])? limpiarCadena($_POST["valorglosa"]):"";
//$devolucion=isset($_POST["devolucion"])? limpiarCadena($_POST["devolucion"]):"";
//$notacredito=isset($_POST["notacredito"])? limpiarCadena($_POST["notacredito"]):"";
//$observaciones=isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]):"";
$usuario=$_SESSION['login'];
//$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		$hoy = date("Y-m-d");
		if (empty($idAF)){
			$rspta=$cambioestado->insertar($codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto, $hoy, $usuario);
			echo $rspta ? "Estado registrado" : "No se pudieron registrar todos los datos.";
			//var_dump($codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto, $hoy, $usuario);
		}
		else {
			$rspta=$cambioestado->editar($idAF, $codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto);
			//echo $rspta ? "Estado actualizado" : "Estado no se pudo actualizar";
			echo "Estado actualizado";
			//var_dump($idAF, $codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto);
		}
	break;

	case 'desactivar':
		$rspta=$cambioestado->desactivar($idAF);
 		echo $rspta ? "Estado Desactivado" : "Estado no se puede desactivar";
	break;

	case 'activar':
		$rspta=$cambioestado->activar($idAF);
 		echo $rspta ? "Estado activado" : "Estado no se puede activar";
	break;

	case 'mostrar':
		$rspta=$cambioestado->mostrar($idAF);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cambioestado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idAF.')"><i class="fa fa-pencil-alt fa-xs"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idAF.')"><i class="fa fa-times fa-xs"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idAF.')"><i class="fa fa-pencil-alt fa-xs"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idAF.')"><i class="fa fa-check fa-xs"></i></button>',
				"1"=>$reg->codprestadorservicio,
				"2"=>$reg->razonsocial,
				"3"=>$reg->tipoidentificacion,
				"4"=>$reg->numeroidentificacion,
				"5"=>$reg->numerofactura,
				"6"=>$reg->fechaexpedicionfactura,
				"7"=>$reg->fechainiciofactura,
				"8"=>$reg->fechafinalfactura,
				"9"=>$reg->codigoentidadadministradora,
				"10"=>$reg->nombreentidadadministradora,
				"11"=>$reg->numerocontacto,
				"12"=>$reg->plandebeneficios,
				"13"=>$reg->numerodepoliza,
				"14"=>$reg->valorcopago,
				"15"=>$reg->valorcomision,
				"16"=>$reg->valordescuentos,
				"17"=>number_format($reg->valorneto),
				"18"=>$reg->fecharadicado,
				"19"=>$reg->glosa,
				"20"=>number_format($reg->valorglosa),
				"21"=>number_format($reg->devolucion),
				"22"=>number_format($reg->notacredito),
				"23"=>$reg->observaciones,
				"24"=>$reg->usuario,
 				"25"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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
