<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeliquidacionAF
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT SUM(valorneto) AS valor FROM AF";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT SUM(valorneto) AS valor, fecharadicado FROM AF WHERE fecharadicado BETWEEN '$fechainicio' AND '$fechafin'";
		return ejecutarConsulta($sql);
	}

}
?>
