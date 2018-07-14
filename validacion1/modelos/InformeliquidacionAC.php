<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeliquidacionAC
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT codigoconsulta, sum(valorneto) AS valor FROM AC GROUP BY codigoconsulta ORDER BY codigoconsulta ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT numerofactura, tipoidentificacion, numeroidentificacion, fechaconsulta, codigoconsulta, fechaconsulta, sum(valorneto) AS valor FROM AC WHERE fechaconsulta BETWEEN '$fechainicio' AND '$fechafin' GROUP BY codigoconsulta ORDER BY codigoconsulta ASC";
		return ejecutarConsulta($sql);
	}
}
?>
