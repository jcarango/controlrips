<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAU
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AU ORDER BY 'idAU' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AU WHERE fechaingresousuario BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idau' ASC";
		return ejecutarConsulta($sql);
	}
}
?>
