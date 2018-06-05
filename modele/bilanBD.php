<?php

function enregistrer_resultat($id_etu, $note){
	require ("modele/connectBD.php");

	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];

	$insert = "INSERT INTO bilan (id_session, id_etu, note) VALUES ('%d', '%d', '%d')";
	$req = sprintf($insert, $id_session, $id_etu, $note);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function get_note($id_etu, $id_session){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM bilan WHERE id_etu = '%d' AND id_session = '%d'";
	$req = sprintf($select, $id_etu, $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$note = mysqli_fetch_assoc($res)['note'];
	return $note;
}

function get_notes_session($id_session){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM bilan WHERE id_session = '%d'";
	$req = sprintf($select, $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e['note'];
	}
	return $C;
}

?>