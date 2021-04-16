<?php
session_start();
$Texto = "Gracias por votar: " . $_SESSION['nombre'] .
	", " . $_SESSION['tipoIden'] . " - " . $_SESSION['ident'];
//echo $Texto;
// diseñar tarde cerificado 
echo '<script type="text/javascript">
		    alert("' . $Texto . '");
		    window.top.location.href="/Vota2/vota";
		    </script>';
//echo "<script>window.top.location.href = \"http://localhost/vota2/vota\";</script>";
?>