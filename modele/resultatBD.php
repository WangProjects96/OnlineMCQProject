<?php

function ajouter_res($id_rep){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];

	$select = "SELECT * FROM reponse WHERE id_rep = '%s'";
	$req = sprintf($select, $id_rep);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$reponse = mysqli_fetch_assoc($res);


	$insert = "insert into resultat (id_session, id_etu, id_quest, id_rep) values ('%d', '%d', '%d', '%d')";
	$req = sprintf($insert, $id_session, $_SESSION['profil']['id_etu'], $reponse['id_quest'], $reponse['id_rep']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function nb_rep($reponse){
	require ("modele/connectBD.php");
	$select = "SELECT id_session FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];
	$select = "SELECT COUNT(*) FROM resultat WHERE id_rep ='%s' AND id_session='%s'";
	$req = sprintf($select, $reponse['id_rep'], $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$nb_rep = mysqli_fetch_assoc($res);
	return $nb_rep['COUNT(*)'];
}

function a_rep($id_etu, $id_rep){
	require ("modele/connectBD.php");

	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];

	$select = "SELECT * FROM resultat WHERE id_etu='%s' AND id_rep='%s' AND id_session='%s'";
	$req = sprintf($select, $id_etu, $id_rep, $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	if (mysqli_num_rows ($res) > 0){
		return true;
	}
	return false;
}

function get_res($id_etu){
	require ("modele/connectBD.php");

	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];

	$select = "SELECT * FROM resultat WHERE id_etu = '%d' AND id_session='%d'";
	$req = sprintf($select, $id_etu, $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);

	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}


?>