<?php

//chez vous, par exemple

$hote='localhost';
$login='root';
$pass='';
$bd='qcm';


 //à l'iut
/*
$hote="localhost";
$login="wang2";
$pass=$login;
$bd="dut2_wang2";
*/

if (! isset($link)) {
	$link = mysqli_connect($hote, $login, $pass)
			or die ("erreur de connexion :" . mysql_error());
	mysqli_select_db($link, $bd)
			or die (htmlentities("erreur d'accès à la base :") . $bd);
}
?>
