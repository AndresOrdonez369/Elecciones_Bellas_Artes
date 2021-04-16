<?php
$usua = $_POST["usua"];

session_start();
if (isset($_POST['enviar_est'])){
	$_SESSION['Tipo'] = "estu";
	$_tipo = "estu";
} else if (isset($_POST['enviar_egr'])){
	$_SESSION['Tipo'] = "egre";
	$_tipo = "egre";
} else if (isset($_POST['enviar_doc'])){
	$_SESSION['Tipo'] = "doce";
	$_tipo = "doce";
}

$inc = include("Conectar_". $_tipo . ".php");
$consulta="select facultad, CONCAT(nombre, ' ', apellido) AS nombre, e.id AS tipo, e.ident
	from " . $_tipo . " e
	left join control c on e.ident = c.ident
	where e.ident = " . $usua .
	" and c.ident is null";

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

//ECHO $consulta;
/* Consultas de selección que devuelven un conjunto de resultados */
if ($resultado = mysqli_query($conex, $consulta)) {
	if (mysqli_num_rows($resultado) > 0){

		$consulta='INSERT INTO control(Ident) VALUES (' . $usua . ')';
		/* comprobar la conexión */
		if (mysqli_connect_errno()) {
		    printf("Falló la conexión: %s\n", mysqli_connect_error());
		    exit();
		}

		if ($conex->query($consulta) === TRUE) {
			session_start();
			$_SESSION['question_start'] = time();

			/* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/Views/Elections";
			while ($mostrar=mysqli_fetch_array($resultado)) {
				session_start();
				if ($_tipo == "egre"){
					$_SESSION['Paso'] = 3;
					$extra = 'v_direc.html';
				} else {
					$_SESSION['Paso'] = 1;
					$extra = 'v_facu_' . $mostrar ['facultad'] . '.html';
				}
				session_start();
				$_SESSION['nombre'] = $mostrar['nombre'];
				session_start();
				$_SESSION['tipoIden'] = $mostrar['tipo'];
				session_start();
				$_SESSION['ident'] = $mostrar['ident'];
			}
			header("Location: http://$host$uri/$extra");
			exit;
		} else {
			echo '<script type="text/javascript">
			    alert("' . $conn->error . '");
			    window.top.location.href="/Vota2/vota";
			    </script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">
		    alert("No autorizado");
		    window.top.location.href="/Vota2/vota";
		    </script>';
	}
    //printf("La selección devolvió %d filas.\n", mysqli_num_rows($resultado));

    // liberar el conjunto de resultados 
    mysqli_free_result($resultado);
}
?>