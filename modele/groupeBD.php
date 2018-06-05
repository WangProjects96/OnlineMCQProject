<?php

function get_nb_eleves($id_grpe) {
	require ("modele/connectBD.php") ;
	$select = "SELECT COUNT(*) FROM etudiant WHERE num_grpe = '%s'";
	$req = sprintf($select, $id_grpe);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$nb_rep = mysqli_fetch_assoc($res)['COUNT(*)'];
	return $nb_rep;
}

function get_groupe($groupe){
	require ("modele/connectBD.php") ;
	$select = "SELECT id_grpe FROM  groupe WHERE num_grpe = '%s'";
	$req = sprintf($select, $groupe);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_grpe = mysqli_fetch_assoc($res)['id_grpe'];
	return $id_grpe;
}

function get_nom_groupe($id_grpe){
	require ("modele/connectBD.php") ;
	$select = "SELECT * FROM  groupe WHERE id_grpe = '%s'";
	$req = sprintf($select, $id_grpe);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$num_grpe = mysqli_fetch_assoc($res)['num_grpe'];
	return $num_grpe;
}

function get_eleves_groupe($id_grpe){
	require ("modele/connectBD.php") ;
	$select = "SELECT * FROM etudiant WHERE num_grpe = '%s'";
	$req = sprintf($select, $id_grpe);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$eleves= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$eleves[] =  $e;
	}
	return $eleves;
}


?>