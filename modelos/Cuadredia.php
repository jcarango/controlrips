<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
$hoy = date("Y-m-d");

Class Cuadredia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM totaldia WHERE fechaingreso >= CURDATE() ORDER BY idtotaldia ASC";
		return ejecutarConsulta($sql);
	}

}
?>
