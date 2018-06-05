<?php

function get_reponses($id_quest){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM reponse WHERE id_quest = '%d'";
	$req = sprintf($select, $id_quest);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function nouvelle_reponse($id_quest, $texte, $bvalide){
	require ("modele/connectBD.php");
	$insert = "INSERT INTO reponse (id_quest, texte_rep, bvalide) VALUES ('%d', '%s', '%d')";
	$req = sprintf($insert, $id_quest, $texte , $bvalide);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

?>