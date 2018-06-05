<?php

function lancer(){
	require ("modele/sessionBD.php");
	$_SESSION['session'] = $_POST['session'];
	$_SESSION['theme'] = $_POST['theme'];;
	$_SESSION['groupe'] = $_POST['groupe'];
	nouvelle_session($_SESSION['session'], $_SESSION['theme'], $_SESSION['groupe']);
	header("Location:index.php?controle=prof&action=bureau");
}

?>

