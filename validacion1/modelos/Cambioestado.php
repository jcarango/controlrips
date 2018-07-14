<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cambioestado
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	//Implementamos un método para insertar registros
	public function insertar($codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto, $fecharadicado, $usuario)
	{
		$sql="INSERT INTO AF (codprestadorservicio, razonsocial, tipoidentificacion, numeroidentificacion, numerofactura, fechaexpedicionfactura, fechainiciofactura, fechafinalfactura, codigoentidadadministradora, nombreentidadadministradora, numerocontacto, plandebeneficios, numerodepoliza, valorcopago, valorcomision, valordescuentos, valorneto, fecharadicado, usuario)
		VALUES ('$codprestadorservicio', '$razonsocial', '$tipoidentificacion', '$numeroidentificacion', '$numerofactura', '$fechaexpedicionfactura', '$fechainiciofactura', '$fechafinalfactura', '$codigoentidadadministradora', '$nombreentidadadministradora', '$numerocontacto', '$plandebeneficios', '$numerodepoliza', '$valorcopago', '$valorcomision', '$valordescuentos', '$valorneto', '$fecharadicado', '$usuario')";
		//return ejecutarConsulta($sql);
		ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idAF, $codprestadorservicio, $razonsocial, $tipoidentificacion, $numeroidentificacion, $numerofactura, $fechaexpedicionfactura, $fechainiciofactura, $fechafinalfactura, $codigoentidadadministradora, $nombreentidadadministradora, $numerocontacto, $plandebeneficios, $numerodepoliza, $valorcopago, $valorcomision, $valordescuentos, $valorneto)
	{
		$sql="UPDATE AF SET codprestadorservicio='$codprestadorservicio', razonsocial='$razonsocial', tipoidentificacion='$tipoidentificacion', numeroidentificacion='$numeroidentificacion', numerofactura='$numerofactura', fechaexpedicionfactura='$fechaexpedicionfactura', fechainiciofactura='$fechainiciofactura', fechafinalfactura='$fechafinalfactura', codigoentidadadministradora='$codigoentidadadministradora', nombreentidadadministradora='$nombreentidadadministradora', numerocontacto='$numerocontacto', plandebeneficios='$plandebeneficios', numerodepoliza='$numerodepoliza', valorcopago='$valorcopago', valorcomision='$valorcomision', valordescuentos='$valordescuentos', valorneto='$valorneto' WHERE idAF='$idAF'";
		ejecutarConsulta($sql);
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

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM AF WHERE estado <> 1";
		return ejecutarConsulta($sql);		
	}
}

?>