<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idAF, razonsocial, numeroidentificacion, numerofactura, valorneto, fecharadicado, usuariocarga, usuario FROM AF";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para eliminar
	public function eliminar($idAF)
	{
		$sql="DELETE FROM AF WHERE idAF='$idAF'";
		return ejecutarConsulta($sql);
	}

	public function totalarchivoshoy()
	{
		$sql="SELECT IFNULL(COUNT(idarchivo),0) AS totala FROM archivos WHERE fecha = curdate()";
		return ejecutarConsulta($sql);		
	}

	public function totalcuentasmedicas()
	{
		$sql="SELECT IFNULL(COUNT(idAF),0) AS totalctasmedicas FROM AF WHERE estado = 1";
		return ejecutarConsulta($sql);		
	}

	public function totalrevision()
	{
		$sql="SELECT IFNULL(COUNT(idAF),0) AS total_revision FROM AF WHERE estado = 2";
		return ejecutarConsulta($sql);		
	}

	public function totalglosada()
	{
		$sql="SELECT IFNULL(COUNT(idAF),0) AS total_glosada FROM AF WHERE estado = 3";
		return ejecutarConsulta($sql);		
	}

	public function totalobjetada()
	{
		$sql="SELECT IFNULL(COUNT(idAF),0) AS total_objetada FROM AF WHERE estado = 4";
		return ejecutarConsulta($sql);		
	}

	public function totalfinalizadas()
	{
		$sql="SELECT IFNULL(COUNT(idAF),0) AS totalfin FROM AF WHERE estado = 0";
		return ejecutarConsulta($sql);		
	}

	public function totalusuarios()
	{
		$sql="SELECT IFNULL(COUNT(idAF),0) AS totales, usuario, estado FROM AF group by usuario, estado";
		return ejecutarConsulta($sql);		
	}
}
?>