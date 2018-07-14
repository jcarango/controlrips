<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class InformeAH
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AH ORDER BY 'idAH' ASC";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AH WHERE fechaingreso BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAH' ASC";
		return ejecutarConsulta($sql);
	}

}
?>
