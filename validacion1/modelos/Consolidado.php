<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consolidado
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT codprestadorservicio, razonsocial, numeroidentificacion, SUM(valorneto) as valorneto FROM AF GROUP BY numeroidentificacion";
		return ejecutarConsulta($sql);
	}

}
?>
