<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consolidadocuentasmedicas
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idAF)
	{
		$sql="SELECT * FROM AF WHERE idAF='$idAF'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AF";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($factura, $identificacion)
	{
		$where = '';
		if (isset($factura) && $factura <> '' && $factura <> null) {
			$where .= " AND numerofactura = '$factura'";
		}

		if (isset($identificacion) && $identificacion <> '' && $identificacion <> null) {
			$where .= " AND numeroidentificacion = '$identificacion'";
		}
		$sql = "SELECT * FROM AF	".$where."";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAC($factura)
	{
		$sql="SELECT * FROM AC WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAP($factura)
	{
		$sql="SELECT * FROM AP WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAU($factura)
	{
		$sql="SELECT * FROM AU WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAH($factura)
	{
		$sql="SELECT * FROM AH WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAN($factura)
	{
		$sql="SELECT * FROM AN WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAM($factura)
	{
		$sql="SELECT * FROM AM WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarUS($factura)
	{
		$sql="SELECT DISTINCT u.*
						FROM US u, AP a
					 WHERE a.numeroidentificacion = u.numeroidentificacion
						 AND a.numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAT($factura)
	{
		$sql="SELECT * FROM AT WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}
}

?>
