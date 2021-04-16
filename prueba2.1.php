<?php
$inc = include("Conectar.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>mostrar datos</title>
</head>
<body>

<br>		
	<table border="1">
				<tr>
					<td>Facultad: </td>	
					<td>Codigo: </td>
					<td>ID: </td>
					<td>Identidad: </td>
					<td>Apellidos: </td>
					<td>Nombres: </td>
				</tr>

				<?php
				$consulta = "SELECT * FROM estu";
				$resultado = mysqli_query($conex,$consulta);

				while ($mostrar=mysqli_fetch_array($resultado)) {
				?>
				
				<tr>

					<td><?php echo $mostrar ['facultad'] ?></td>
					<td><?php echo $mostrar ['codigo'] ?></td>
					<td><?php echo $mostrar ['id'] ?></td>
					<td><?php echo $mostrar ['ident'] ?></td>
					<td><?php echo $mostrar ['apellido'] ?></td>
					<td><?php echo $mostrar ['nombre'] ?></td>
				</tr>
				<?php
				}		
			?>				
			</table>
			</body>
</html>