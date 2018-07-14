<?php
session_start(); 
require_once "../modelos/Ingreso.php";

$ingreso=new Ingreso();

$archivo=isset($_POST["archivo"])? limpiarCadena($_POST["archivo"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':


	$status = "";
	if ($_POST["action"] == "upload") {
	    // obtenemos los datos del archivo
	    $tamano = $_FILES["archivo"]['size'];
	    $tipo = $_FILES["archivo"]['type'];
	    $archivo = $_FILES["archivo"]['name'];
	    $prefijo = substr(md5(uniqid(rand())),0,6);

	    if ($archivo != "") {
	        // guardamos el archivo a la carpeta files
	        $destino =  "../files/rips/".$prefijo."_".$archivo;
	        if (copy($_FILES['archivo']['tmp_name'],$destino)) {
	            $status = "Archivo subido: <b>".$archivo."</b>";
	        } else {
	            $status = "Error al subir el archivo";
	        }
	    } else {
	        $status = "Error al subir archivo";
	    }
	}

		
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