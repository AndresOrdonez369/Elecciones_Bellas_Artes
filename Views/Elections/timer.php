<!DOCTYPE html>
<html>

<body>
	<p style="color: #FFFFFF">
<?php
session_start();
$time = time() - $_SESSION['question_start'];
$limit = $_SESSION['question_start'] + 600;
if(time() > $limit)
{
	echo '<script type="text/javascript">
		alert("Fin del tiempo");
		window.top.location.href="/Vota2/vota";
		</script>';
} else {
	echo "Tiempo transcurrido: ";
	echo date('i:s', $time);
	echo "\n";
	echo "Recuerde que el tiempo límite es 10 minutos.";
	header("Refresh: 1");
}
?>
	</p>
</body>
</html>