<?php

function nouvelle_session($session, $theme, $groupe){
	require ("modele/connectBD.php");
	$insert = "INSERT INTO session (id_theme, titre_sess, id_grpe, date_sess) values ('%d', '%s', '%d', current_date())";
	$select = "SELECT * FROM theme WHERE descr_theme = '%s'";
	$req = sprintf($select, $theme);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_theme = mysqli_fetch_assoc($res)['id_theme'];

	$select = "SELECT * FROM groupe WHERE num_grpe = '%s'";
	$req = sprintf($select, $groupe);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_groupe = mysqli_fetch_assoc($res)['id_grpe'];

	$req = sprintf($insert, $id_theme, $session, $id_groupe);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);

}

function liste_themes() {
	require ("modele/connectBD.php") ;	
	$req =  "SELECT descr_theme FROM theme ";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req); 

	// On déclare un teableau pour stocker les sessions
	$C= array();
	 //stockage des enregistrements (résultats de la requete) dans $C => utiliser mysqli_fetch_assoc pour générer des tableaux associatifs
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function liste_groupes() {
	require ("modele/connectBD.php") ;	
	$req =  "SELECT num_grpe FROM groupe";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req); 

	// On déclare un teableau pour stocker les sessions
	$C= array();
	 //stockage des enregistrements (résultats de la requete) dans $C => utiliser mysqli_fetch_assoc pour générer des tableaux associatifs
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function get_theme($id_theme){
	require ("modele/connectBD.php") ;
	$select =  "SELECT descr_theme FROM theme WHERE id_theme = '%s'";
	$req = sprintf($select, $id_theme);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$theme = mysqli_fetch_assoc($res);
	return $theme;
}

function get_session($id_quest){
	require ("modele/connectBD.php") ;
	$select =  "SELECT * FROM session WHERE id_session IN (SELECT id_session FROM test WHERE id_quest = '%s')";
	$req = sprintf($select, $id_quest);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$session = mysqli_fetch_assoc($res)['titre_sess'];
	return $session;
}

function get_id_theme($nom_theme){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM theme WHERE descr_theme = '%s'";
	$req = sprintf($select, $nom_theme);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_theme = mysqli_fetch_assoc($res)['id_theme'];
	return $id_theme;
}

function get_sessions(){
	require ("modele/connectBD.php") ;	
	$req =  "SELECT * FROM session";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req); 

	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

?>