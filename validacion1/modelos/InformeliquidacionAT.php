<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeliquidacionAT
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT codigoservicio, SUM(valortotalmaterial) AS valor FROM AT GROUP BY codigoservicio ORDER BY codigoservicio ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT codigoservicio, SUM(valortotalmaterial) AS valor FROM AT WHERE fecha BETWEEN '$fechainicio' AND '$fechafin' ORDER BY codigoservicio ASC";
		return ejecutarConsulta($sql);
	}

}
?>
