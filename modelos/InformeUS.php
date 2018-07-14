<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeUS
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM US ORDER BY 'idUS' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM US WHERE fecha BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idUS' ASC";
		return ejecutarConsulta($sql);
	}

}
?>
