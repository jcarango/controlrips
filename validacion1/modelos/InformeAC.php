<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAC
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar($fechainicio, $fechafin)
	{
		$sql="SELECT * FROM AC ORDER BY 'idAC' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AC WHERE fechaconsulta BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAC' ASC";
		return ejecutarConsulta($sql);
	}
}
?>
