<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeliquidacionAM
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT codigomedicamento, sum(valortotalmedicamento) AS valor FROM AM GROUP BY codigomedicamento ORDER BY codigomedicamento ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT codigomedicamento, sum(valortotalmedicamento) AS valor FROM AM WHERE fechaconsulta BETWEEN '$fechainicio' AND '$fechafin' GROUP BY codigomedicamento ORDER BY codigomedicamento ASC";
		return ejecutarConsulta($sql);
	}
}
?>
