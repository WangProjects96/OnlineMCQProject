<?php

function get_all_questions(){
	require ("modele/connectBD.php") ;	
	$req =  "SELECT * FROM question";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req); 
	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function get_questions($session) {
	require ("modele/connectBD.php") ;	
	$select =  "SELECT * FROM question WHERE id_theme IN (SELECT id_theme FROM session WHERE titre_sess = '%s')";
	$req = sprintf($select, $session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req); 
	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function ajouter_quest($id_quest){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];
	$insert = "INSERT INTO test (id_session, id_quest, bAutorise) values ('%d', '%d', true)";
	$req = sprintf($insert, $id_session, $id_quest);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function supprimer($id_quest){
	require ("modele/connectBD.php");
	$delete = "DELETE FROM test WHERE id_quest = '%s'";
	$req = sprintf($delete, $id_quest);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function enlever_question($id_quest){
	require ("modele/connectBD.php");
	$update = "UPDATE test SET bAutorise = false WHERE id_quest = '%s'";
	$req = sprintf($update, $id_quest);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function get_questions_auto(){
	require ("modele/connectBD.php") ;
	$req =  "SELECT * FROM question WHERE id_quest IN (SELECT id_quest FROM test WHERE bAutorise = true)";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function annuler_question($id_quest){
	require ("modele/connectBD.php");

	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];

	$delete = "DELETE FROM resultat WHERE id_quest = '%s' AND id_session = '%s'";
	$req = sprintf($delete, $id_quest, $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function get_nb_rep($id_quest){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM session WHERE titre_sess = '%s'";
	$req = sprintf($select, $_SESSION['session']);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_session = mysqli_fetch_assoc($res)['id_session'];

	$select = "SELECT COUNT(DISTINCT id_etu) FROM resultat WHERE id_quest = '%s' AND id_session='%s'";
	$req = sprintf($select, $id_quest, $id_session);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$nb_rep = mysqli_fetch_assoc($res)['COUNT(DISTINCT id_etu)'];
	return $nb_rep;
}

function get_question($id_rep){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM question WHERE id_quest IN (SELECT id_quest FROM reponse WHERE id_rep='%s')";
	$req = sprintf($select, $id_rep);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$question = mysqli_fetch_assoc($res);
	return $question;
}

function get_question_theme($id_theme){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM question where id_theme = '%s'";
	$req = sprintf($select, $id_theme);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$C= array();
	while ($e = mysqli_fetch_assoc($res) and isset($e)) {
		$C[] =  $e;
	}
	return $C;
}

function set_questions($id_quest,$id_theme,$titre,$texte,$bmultiple){
	require ("modele/connectBD.php");
	$insert = "INSERT INTO question (id_quest,id_theme,titre,texte,bmultiple) VALUES ('%d', '%d', '%d', '$s', '$d')";
	$req = sprintf($insert, $id_quest,$id_theme,$titre,$texte,$bmultiple);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function get_nb_questions(){
	require ("modele/connectBD.php");
	$select = "SELECT COUNT(id_quest) FROM question";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$nb_questions = mysqli_fetch_assoc($res)['COUNT(id_quest)'];
	return $nb_questions;
}

function get_nb_titres($id_theme){
	require ("modele/connectBD.php");
	$select = "SELECT COUNT(titre) FROM question WHERE id_theme = '%s'";
	$req = sprintf($select, $id_theme);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$nb_titres = mysqli_fetch_assoc($res);
	return $nb_titres['COUNT(titre)'];
}

function nouvelle_question($id_theme, $texte, $bmultiple){
	require ("modele/connectBD.php");
	$titre = get_nb_titres($id_theme) + 1;
	$insert = "INSERT INTO question (id_theme, titre, texte, bmultiple) values ('%d', '%s', '%s', '%d')";
	$req = sprintf($insert, $id_theme, $titre, $texte, $bmultiple);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
}

function get_id_quest($texte){
	require ("modele/connectBD.php");
	$select = "SELECT * FROM question WHERE texte = '%s'";
	$req = sprintf($select, $texte);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	$id_quest = mysqli_fetch_assoc($res)['id_quest'];
	return $id_quest;
}

?>