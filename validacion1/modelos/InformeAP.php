<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAP
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AP ORDER BY 'idAP' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AP WHERE fechaprocedimiento BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAP' ASC";
		return ejecutarConsulta($sql);
	}
}
?>
