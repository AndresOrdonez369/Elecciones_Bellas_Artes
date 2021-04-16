<!DOCTYPE html>
<html>
<head>
	<title>Mostar datos</title>
</head>
<body>
	<br>
	<table>
		<tr>
			<td>Facultad</td>
			<td>Codigo</td>
			<td>ID</td>
			<td>Identidad</td>
			<td>Apellidos</td>
			<td>Nombres</td>
		</tr>
		<?php
		$sql="select * from t_estu";
		$result=mysqli_query($connectDB,$sql);
		
		while($mostrar=mysqli_fetch_array($result)){
			?>

		<tr>
			<td>php echo $mostrar['FACULAD']</td>
			<td>php echo $mostrar['CODIGO']</td>
			<td>php echo $mostrar['ID']</td>
			<td>php echo $mostrar['IDENT']</td>
			<td>php echo $mostrar['APELLIDOS']</td>
			<td>php echo $mostrar['NOMBRES']</td>
		</tr>
		<?php
	}
	?>
	</table>
</body>
</html>


