<?php 

function afficher($id_quest){

	if (!isset($_SESSION['reponses'])){
		$_SESSION['reponses'] = true;
	}else {
		$_SESSION['reponses'] = !$_SESSION['reponses'];
	}

	header("Location:index.php?controle=prof&action=bureau");	
}


function valider($id_quest){
	require("modele/resultatBD.php");
	foreach($_POST['resu'] as $res)
		{
			ajouter_res($res);
		}
	$_SESSION['valider'][$id_quest] = true;
	header("Location:index.php?controle=eleve&action=bureau");	
}

function afficherAR(){
	require("controle/prof.php");
	require ("modele/questionsBD.php");
	require ("modele/resultatBD.php");
	require ("modele/reponsesBD.php");
	require ("modele/groupeBD.php");
	$liste_reponses = array();
	$questions = get_questions($_SESSION['session']);

	for($i=0;$i<count($questions);$i++){
		$liste_reponses[$i] = get_reponses($questions[$i]['id_quest']);
	}

	
	require("vue/prof/ajout_reponses.tpl");
}

function ajouter_rep() {
	require("modele/reponsesBD.php");
	require("modele/questionsBD.php");
	require ("modele/sessionBD.php");
	$bvalide = false;
	if($_POST['validite'] == "oui"){
		$bvalide = true;
	}
	$id_quest = get_id_quest($_POST['question']);
	$texte_rep = $_POST['texte'];
	nouvelle_reponse($id_quest, $texte_rep, $bvalide);
	header("Location:index.php?controle=prof&action=ajout_reponses");

}


