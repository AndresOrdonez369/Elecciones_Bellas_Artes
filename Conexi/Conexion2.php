<?

function conectar(){

	$user="root";
	$Pass="";
	$server="Localhost";
	$db="estudiantes";
	$con=mysql_connect($server,$user,$pass) or die ("Error al conectar a la base de datos" .mysql_error());	
	mysql_select_db($db,$con);
	return $con;

}
?>