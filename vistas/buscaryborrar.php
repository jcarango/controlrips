<meta charset="utf-8">
<style>
 table {
  box-shadow: 35px 35px 80px #ccc;
 }
</style>
<?
//Mostramos el formulario de búsqueda con dos campos tipo (dos opciones) y termino
if(!$_POST) {
?>
<form action="<? $_POST ?>" method=post>
<br><br><table border=1 width=500 align=center>
 <tr align=center><td bgcolor=#75f colspan=2>Busca el registro que deseas borrar</td></tr>
 <tr>
  <td>Tipo de búsqueda</td>
  <td>
   <select name=tipo>
    <option value=idAF>ID
    <option value=numerofactura>Factura
   </select>
 </tr>
 <tr>
  <td>Término de la búsqueda</td>
  <td><input type=text name=termino></td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><input type=submit value=Buscar></td>
 </tr>
</table>
</form>
<?
} else {
 $tipo = $_POST['tipo'];
 $termino = $_POST['termino'];
 
 //conectar con el servidor
 @$db = mysql_connect("localhost", "root", "Albion98") or die ("No es posible conectar con el servidor.");
 //seleccionamos la base de datos
 mysql_select_db("controlrips");
 
 //hacemos la busqueda
 $buscar = mysql_query("SELECT idAF, numerofactura FROM AF WHERE $tipo LIKE '%".$termino."%'");
 $num_rows = mysql_num_rows($buscar);
 
 //Creamos un ciclo para mostrar los registros resultado de la búsqueda realizada.
 for($i=1; $i<=$num_rows; $i++) {
  $datos = mysql_fetch_array($buscar);
  $id = $datos['idAF'];
  $numerofactura = $datos['numerofactura'];
  echo "<form action=borrar.php method='GET'>";
  echo "<br><table border=1 width=500 align=center>";
   echo "<tr align=center><td colspan=2>Datos a eliminar</td></tr>";
   echo "<input type=hidden name=id value='$id'>";
   echo "<tr><td>Nombre:</td><td><input type=text value='$numerofactura'></td></tr>";
   echo "<tr><td colspan=2><input type=submit value='Borrar definitivamente'></td></tr>";
  echo "</table>";
  echo "</form>";
 }
}

?>