<?php
$inc = include("Conectar.php");

$usua = $_POST["usua"];
$consulta='select * from estu where ident = ' . $usua;

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

/* Consultas de selección que devuelven un conjunto de resultados */
if ($resultado = mysqli_query($conex, $consulta)) {
	if (mysqli_num_rows($resultado) > 0){
		printf("Bienvenido");
		
	}
	else
	{
		printf("Chao");
	}
    //printf("La selección devolvió %d filas.\n", mysqli_num_rows($resultado));

    // liberar el conjunto de resultados 
    mysqli_free_result($resultado);
}
?>