<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeliquidacionAP
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT codigoprocedimiento, sum(valorprocedimiento) AS valor FROM AP GROUP BY codigoprocedimiento ORDER BY codigoprocedimiento ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT codigoprocedimiento, sum(valorprocedimiento) AS valor FROM AP WHERE fechaprocedimiento BETWEEN '$fechainicio' AND '$fechafin' ORDER BY codigoprocedimiento ASC";
		return ejecutarConsulta($sql);
	}
}
?>
