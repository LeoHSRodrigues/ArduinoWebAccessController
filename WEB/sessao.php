<?php
session_start();
if (isset($_SESSION['atividade']) && (time() - $_SESSION['atividade'] < 21600)) {
	$_SESSION['atividade'] = time();
	
}
else{
	echo '<script>window.location.href = "logout.php";</script>';
}
?>