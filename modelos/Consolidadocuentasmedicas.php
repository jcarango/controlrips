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

	public function buscarFechas($factura, $identificacion, $fechainicio, $fechafin, $usuario)
	{
		$where = " WHERE fechaexpedicionfactura BETWEEN '$fechainicio' AND '$fechafin' AND usuario = '$usuario'";
		if (isset($factura) && $factura <> '' && $factura <> null) {
			$where .= " AND numerofactura = '$factura'";
		}

		if (isset($identificacion) && $identificacion <> '' && $identificacion <> null) {
			$where .= " AND numeroidentificacion = '$identificacion'";
		}
		$sql = "SELECT * FROM AF ".$where."";

        return ejecutarConsulta($sql);
	}


    public function buscarFechasTotalF($factura, $identificacion, $fechainicio, $fechafin, $usuario)
    {
        $where = " WHERE fechaexpedicionfactura BETWEEN '$fechainicio' AND '$fechafin' AND usuario = '$usuario'";
        if (isset($factura) && $factura <> '' && $factura <> null) {
            $where .= " AND numerofactura = '$factura'";
        }

        if (isset($identificacion) && $identificacion <> '' && $identificacion <> null) {
            $where .= " AND numeroidentificacion = '$identificacion'";
        }
        $sql = "SELECT DISTINCT(F.numerofactura), 
						(
							IFNULL((select sum(C.valorglosa) from AC C where C.numerofactura = F.numerofactura),0) +
							IFNULL((select sum(M.valorglosa) from AM M where M.numerofactura = F.numerofactura),0) +
							IFNULL((select sum(N.valorglosa) from AN N where N.numerofactura = F.numerofactura),0) +
							IFNULL((select sum(P.valorglosa) from AP P where P.numerofactura = F.numerofactura),0) +
							IFNULL((select sum(U.valorglosa) from AU U where U.numerofactura = F.numerofactura),0) +
							IFNULL((select sum(T.valorglosa) from AT T where T.numerofactura = F.numerofactura),0) 
						) total
				FROM AF F ".$where."";

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
