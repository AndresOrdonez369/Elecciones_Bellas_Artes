<?php

function voto1(){
	session_start();
	if ($_SESSION['Tipo'] == "estu"){
		$_tipo = "estu";
	} else if ($_SESSION['Tipo'] == "egre"){
		$_tipo = "egre";
	} else if ($_SESSION['Tipo'] == "doce"){
		$_tipo = "doce";
	}
	$inc = include("Conectar_" . $_tipo . ".php");

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/Views/Elections";

	if (isset($_POST["Candidato"])){
		$Cand = $_POST["Candidato"];

		session_start();
		if (isset($_POST["Vota1"]) && $_SESSION['Paso'] == 1){
			$Secc = 1;
			$_SESSION['Paso'] = 2;
		} else if (isset($_POST["Vota2"]) && $_SESSION['Paso'] == 1){
			$Secc = 2;
			$_SESSION['Paso'] = 2;
		} else if (isset($_POST["Vota3"]) && $_SESSION['Paso'] == 1){
			$Secc = 3;
			$_SESSION['Paso'] = 2;
		} else if (isset($_POST["Vota4"]) && $_SESSION['Paso'] == 2){
			$Secc = 4;
			$_SESSION['Paso'] = 3;
		} else if (isset($_POST["Vota5"]) && $_SESSION['Paso'] == 3){
			$Secc = 5;
			$_SESSION['Paso'] = 4;
		}

		$consulta='INSERT INTO votos(seccion, idCandidato) VALUES (' . $Secc . ', ' . $Cand . ')';
		/* comprobar la conexión */
		if (mysqli_connect_errno()) {
		    printf("Falló la conexión: %s\n", mysqli_connect_error());
		    exit();
		}

		if ($conex->query($consulta) === TRUE) {
		  	/* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
			if (isset($_POST["Vota1"]) || isset($_POST['Vota2']) || isset($_POST['Vota3'])){
				$extra = 'v_acadi.html';
			} else if (isset($_POST["Vota4"])){
				$extra = 'v_direc.html';
			} else if (isset($_POST["Vota5"])){
				$extra = '../../fin.php';
			}
			header("Location: http://$host$uri/$extra");
			exit;
		} else {
			echo '<script type="text/javascript">
			    alert("' . $conex->error . '");
			    window.top.location.href="/Vota2/vota";
			    </script>';
		}
	} else {
	  	/* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
		if (isset($_POST["Vota1"])){
			$extra = 'v_facu_CAMV.html';
		} else if (isset($_POST['Vota2'])){
			$extra = 'v_facu_FAE.html';
		} else if (isset($_POST['Vota3'])){
			$extra = 'v_facu_FAVA.html';
		} else if (isset($_POST["Vota4"])){
			$extra = 'v_acadi.html';
		} else if (isset($_POST["Vota5"])){
			$extra = 'v_direc.html';
		}

		header("Location: http://$host$uri/$extra");
		exit;
	}
}

if(isset($_POST['Vota1']) || isset($_POST['Vota2']) || isset($_POST['Vota3'])
	|| isset($_POST['Vota4']) || isset($_POST['Vota5']))
{
	session_start();
	if (((isset($_POST['Vota1']) || isset($_POST['Vota2']) || isset($_POST['Vota3'])) && $_SESSION['Paso'] != 1)
		|| (isset($_POST['Vota4']) && $_SESSION['Paso'] != 2)
		|| (isset($_POST['Vota5']) && $_SESSION['Paso'] != 3))
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/Views/Elections";;

		if ($_SESSION['Paso'] == 4){
			$extra = 'fin.php';
		} else if ($_SESSION['Paso'] == 3){
			$extra = 'v_direc.html';
		} else if ($_SESSION['Paso'] == 2){
			$extra = 'v_acadi.html';
		} else {
			$extra = '../../';
		}
		header("Location: http://$host$uri/$extra");
		exit;
	} else {
		voto1();
	}
}
?>