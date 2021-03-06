<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cuentasmedicas
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	public function glosas()
	{
		$sql="SELECT * FROM glosas";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idAF, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones, $usuario)
	{
		$sql="UPDATE AF SET glosa='$glosa', valorglosa = '$valorglosa', devolucion='$devolucion', notacredito='$notacredito', observaciones='$observaciones', usuario='$usuario', estado=0 WHERE idAF='$idAF'";
		ejecutarConsulta($sql);
		return true;
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idAF)
	{
		$sql="UPDATE AF SET estado='0' WHERE idAF='$idAF'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idAF)
	{
		$sql="UPDATE AF SET estado='1' WHERE idAF='$idAF'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idAF)
	{
		$sql="SELECT * FROM AF WHERE idAF='$idAF'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrarhistorial($factura)
	{
		$sql="SELECT * FROM auditoria_cuentasmedicas WHERE factura='$factura'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AF WHERE estado=1 AND estadopersistencia = 1";
		return ejecutarConsulta($sql);
	}

	public function buscarFechas($fechainicio, $fechafin, $factura, $identificacion)
	{
		$where = '';
		if (isset($factura) && $factura <> '' && $factura <> null) {
			$where .= " AND numerofactura = '$factura'";
		}

		if (isset($identificacion) && $identificacion <> '' && $identificacion <> null) {
			$where .= " AND numeroidentificacion = '$identificacion'";
		}
		$sql = "SELECT *
							FROM AF
						 WHERE fecharadicado BETWEEN '$fechainicio' AND '$fechafin'
					".$where."
					ORDER BY 'fecharadicado' ASC";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function buscarAC($factura)
	{
		$sql="SELECT * FROM AC WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAC($factura, $idAC, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AC SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAC = '$idAC'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AC WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}

	//Implementar un método para listar los registros
	public function buscarAP($factura)
	{
		$sql="SELECT * FROM AP WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAP($factura, $idAP, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AP SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAP = '$idAP'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AP WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}

	//Implementar un método para listar los registros
	public function buscarAU($factura)
	{
		$sql="SELECT * FROM AU WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAU($factura, $idAU, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AU SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAU = '$idAU'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AU WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}

	//Implementar un método para listar los registros
	public function buscarAH($factura)
	{
		$sql="SELECT * FROM AH WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAH($factura, $idAH, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AH SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAH = '$idAH'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AH WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}

	//Implementar un método para listar los registros
	public function buscarAN($factura)
	{
		$sql="SELECT * FROM AN WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAN($factura, $idAN, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AN SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAN = '$idAN'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AN WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}

	//Implementar un método para listar los registros
	public function buscarAM($factura)
	{
		$sql="SELECT * FROM AM WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAM($factura, $idAM, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AM SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAM = '$idAM'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AM WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
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
	public function updateUS($factura, $idUS, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		if ($notacredito == "") {
			$notacredito = 0;
		}
		if ($valorglosa == "") {
			$valorglosa = 0;
		}
		if ($glosa == "") {
			$glosa = 0;
		}
		$sql="UPDATE US SET glosa=$glosa, valorglosa = $valorglosa, estado = 0, devolucion = '$devolucion', notacredito = $notacredito, observaciones = '$observaciones'
		       WHERE idUS = $idUS";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT DISTINCT u.*
						FROM US u, AP a
					 WHERE a.numeroidentificacion = u.numeroidentificacion
						 AND a.numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}

	//Implementar un método para listar los registros
	public function updateAF($factura, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		if ($devolucion == "") {
			$devolucion = 0;
		}
		if ($valorglosa == "") {
			$valorglosa = 0;
		}
		if ($glosa == "") {
			$glosa = 0;
		}
		$sql="UPDATE AF SET usuario = '".$_SESSION['idusuario']."', glosa=$glosa, valorglosa = $valorglosa, estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE numerofactura = $factura";
		$r = ejecutarConsulta($sql);
		return true;
	}

	//Implementar un método para listar los registros
	public function buscarAT($factura)
	{
		$sql="SELECT * FROM AT WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function updateAT($factura, $idAT, $valorglosa, $glosa, $devolucion, $notacredito, $observaciones)
	{
		$sql="UPDATE AT SET glosa='$glosa', valorglosa = '$valorglosa', estado = 0, devolucion = $devolucion, notacredito = $notacredito, observaciones = '$observaciones' WHERE idAT = '$idAT'";
		$r = ejecutarConsulta($sql);

		$sql2="SELECT * FROM AT WHERE numerofactura = '$factura'";// AND estado = 1";
		return ejecutarConsulta($sql2);
	}
}

?>
