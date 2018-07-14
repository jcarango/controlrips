<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAT
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AT ORDER BY 'idAT' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AT WHERE fecharadicado BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAT' ASC";
		return ejecutarConsulta($sql);
	}

}
?>
