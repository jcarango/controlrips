<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contabilidad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AF ORDER BY 'idAF' ASC LIMIT 1000";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin)
	{
		$sql = "SELECT * FROM AF WHERE fecharadicado BETWEEN '$fechainicio' AND '$fechafin' ORDER BY 'idAF' DESC LIMIT 1000";
		return ejecutarConsulta($sql);
	}

}
?>
