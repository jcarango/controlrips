<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeCT
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM CT ORDER BY 'idCT' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM CT WHERE fecha BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idCT' ASC";
		return ejecutarConsulta($sql);
	}

}
?>
