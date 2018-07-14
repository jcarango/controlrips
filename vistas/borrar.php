<meta charset="utf-8">
<?
$id = $_GET['idAF'];
$nombre = $_GET['numerofactura'];

//conectar con el servidor
  @$db = mysql_connect("localhost", "root", "Albion98") or die ("No es posible conectar con el servidor.");
 //seleccionamos la base de datos
 mysql_select_db("controlrips");
  
$consultar = mysql_query("SELECT * FROM AF");

mysql_query("DELETE FROM AF WHERE idAF = '$idAF'");

echo "Se ha eliminado el registro con éxito.<br>";
echo "Espere tres segundos será redireccionado a Buscar y Borrar datos!";

?>
<script language="Javascript">

function redireccionar() {
setTimeout("location.href='buscaryborrar.php'", 3000);}
redireccionar();
</script>

<?

if(!$consultar) {
 echo "No se encontraron coincidencias";
}

?>