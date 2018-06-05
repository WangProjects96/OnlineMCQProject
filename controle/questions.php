<?php 

function autoriser($id_quest){
	require ("modele/questionsBD.php");
	$_SESSION['questions'][$id_quest]="presse";
	ajouter_quest($id_quest);
	$_SESSION['quest_ajoute'][$id_quest] = true;
	header("Location:index.php?controle=prof&action=bureau_questions");	
}

function annuler($id_quest){
	require ("modele/questionsBD.php");
	$_SESSION['questions'][$id_quest]="annule";
	annuler_question($id_quest);
	supprimer($id_quest);
	header("Location:index.php?controle=prof&action=bureau_questions");	
}

function fin($id_quest){
	require ("modele/questionsBD.php");
	enlever_question($id_quest);
	$_SESSION['questions'][$id_quest]="gris";
	header("Location:index.php?controle=prof&action=bureau_questions");	
}

function confirmer(){
	require ("modele/sessionBD.php");
	require ("modele/questionsBD.php");
	$bmultiple = false;
	if($_POST['QCM'] == "multiple"){
		$bmultimple = true;
	}
	$id_theme = get_id_theme($_POST['theme']);
	$texte = $_POST['texte'];
	nouvelle_question($id_theme, $texte, $bmultiple);
	header("Location:index.php?controle=prof&action=ajout_questions");	
}



