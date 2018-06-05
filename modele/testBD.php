<?php

function test_commence($eleve) {
	require ("modele/connectBD.php") ; 
	$req = "SELECT * from test"; 
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req); 

	while ($e = mysqli_fetch_assoc($res) and isset($e)) {

		$select = "SELECT * FROM groupe WHERE id_grpe IN (SELECT id_grpe FROM session WHERE id_session = '%s')";
		$req = sprintf($select, $e['id_session']);
		$resultat = mysqli_query($link, $req)	
			or die (utf8_encode("erreur de requête : ") . $req); 
		$num_grpe = mysqli_fetch_assoc($resultat)['id_grpe'];

		if($e['bAutorise'] && $eleve['num_grpe'] == $num_grpe){
			return true;
		}
	}
	return false;
}

function cloturer(){
	require ("modele/connectBD.php") ;
	$req = "DELETE FROM test";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$req = "DELETE FROM resultat";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function get_questions_test(){
	require ("modele/connectBD.php");
	$req = "SELECT * FROM question WHERE id_quest IN (SELECT id_quest FROM test)"; 
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$questions = array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$questions[] =  $e;
	}
	return $questions;
}

?>