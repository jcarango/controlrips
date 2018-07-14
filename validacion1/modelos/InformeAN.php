<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAN
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AN ORDER BY 'idAN' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AN WHERE fechanacimiento BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAN' ASC";
		return ejecutarConsulta($sql);
	}

}
?>
