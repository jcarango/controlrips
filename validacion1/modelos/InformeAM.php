<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAM
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AM ORDER BY 'idAM' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AM WHERE fecha BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAM' ASC";
		return ejecutarConsulta($sql);
	}

}
?>
