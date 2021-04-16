<? php
$conexion = connectDB();
mysqli_set_charset($conexion, "utf8");

$sql = "SELECT * from estudiantes";
$ejecutar = mysql_query($sql);
	if(!$ejecutar){
		echo "Hay un error en la sentencia de sql:".$sql;
	}else{
		
	$estudiantes = 10;
			}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Prueba</title>
</head>
<body>
	<table>
		<tr>
			<td>facultad</td>
			<td>codigo</td>	
			<td>id</td>
			<td>ident</td>
			<td>apellidos</td>
			<td>nombres</td>
		</tr>
		<?php
				for($i=0; $i<$estudiantes; $i++){
						echo"<tr>";
							echo"<td>";
								echo$sql['FACULTAD'];
							echo"</td>";
							
							echo"<td>";
								echo$sql['CODIGO'];
							echo"</td>";
						echo"</tr>";
						
						$estu = mysql_fetch_array($ejecutar);	
					}
				
		?>
	</table>
</body>
</html>