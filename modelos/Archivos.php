<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Archivos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM archivos ORDER BY 'idarchivos' ASC LIMIT 1000";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM archivos WHERE fecha BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idarchivos' ASC LIMIT 1000";
		return ejecutarConsulta($sql);
	}

}
?>
