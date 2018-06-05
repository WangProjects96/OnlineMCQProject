<?php 


function selection(){
	require ("modele/sessionBD.php"); 
	$themes = liste_themes();
	$groupes = liste_groupes();
	require("vue/prof/selection.tpl");
}

function bureau(){
	require ("modele/questionsBD.php");
	$questions = get_questions($_SESSION['session']);
	$reponses = array();
	require ("modele/reponsesBD.php");
	for($i=0;$i<count($questions);$i++){
		$reponses[] = get_reponses($questions[$i]['id_quest']);
	}
	require("vue/prof/bureau.tpl");
}

function retourSelection(){
	require("modele/testBD.php");
	cloturer();
	$profil = $_SESSION['profil'];
	session_destroy();
	session_start();
	$_SESSION['profil'] = $profil;
	header("Location:index.php?controle=prof&action=selection");
}

function retourMenu(){
	require("modele/testBD.php");
	cloturer();
	$profil = $_SESSION['profil'];
	session_destroy();
	session_start();
	$_SESSION['profil'] = $profil;
	header("Location:index.php?controle=prof&action=menu");
}

function bureau_questions(){
	require ("modele/questionsBD.php");
	require ("modele/resultatBD.php");
	require ("modele/reponsesBD.php");
	require ("modele/groupeBD.php");
	require ("modele/testBD.php");
	$nb_restant = array();
	$questions = get_questions($_SESSION['session']);
	$resu = array();
	$reponses = array();

	$questions_bilan = get_questions_test();


	/*if(!isset($_SESSION['questions'])){
		$message_erreur = "Vous n'avez pas sélectionné de question !";
	}*/
	
	/*On récupère le nombre d'élèves ayant donné chaque réponse*/
	for($i=0;$i<count($questions);$i++){
		$reponses[$i] = get_reponses($questions[$i]['id_quest']);
		for($j=0; $j<count($reponses[$i]);$j++){
			$resu[$i][$j] = nb_rep($reponses[$i][$j]);
		}
		$nb_restant[] = get_nb_eleves(get_groupe($_SESSION['groupe'])) - get_nb_rep($questions[$i]['id_quest']);
	}
	require("vue/prof/bureau_questions.tpl");
}

function menu(){
	require("vue/prof/menu.tpl");
}

function ajout_questions($page){
	require ("modele/sessionBD.php"); 
	$texte = '';
	$themes = liste_themes();
	$page_prec = $page;
	require("vue/prof/ajout_questions.tpl");
}

function ajout_reponses($page){
	require ("modele/sessionBD.php");
	require ("modele/questionsBD.php"); 
	$texte = '';
	$page_prec = $page;
	$questions = get_all_questions();
	require("vue/prof/ajout_reponses.tpl");
}

function bilan_sessions_prec(){
	require ("modele/groupeBD.php");
	require ("modele/sessionBD.php");
	require ("modele/bilanBD.php");
	//On récup les sesions précédentes
	$sessions = get_sessions();
	//On va le remplir avec le thème de chaque session
	$themes = array();
	//On va le remplir avec le groupe de chaque session
	$groupes = array();

	$bilan = array();

	for ($i=0; $i < count($sessions) ; $i++){
		$themes[$i] = get_theme($sessions[$i]['id_theme']);
		$groupes[$i] = get_nom_groupe($sessions[$i]['id_grpe']);
		$bilan[$i]['etudiants'] = get_eleves_groupe($sessions[$i]['id_grpe']);
		for ($j=0; $j < count($bilan[$i]['etudiants']) ; $j++){
			if(get_note($bilan[$i]['etudiants'][$j]['id_etu'], $sessions[$i]['id_session']) == -1){
				$bilan[$i]['notes'][$j] = "abs";
			}else{
				$bilan[$i]['notes'][$j] = get_note($bilan[$i]['etudiants'][$j]['id_etu'], $sessions[$i]['id_session']);
			}
		}
	}

	$moyenne = array();
	for($i=0; $i < count($bilan); $i ++){
		$nb_presents = 0;
		$moyenne[$i] = 0;
		for ($j=0; $j < count($bilan[$i]['etudiants']) ; $j++){
			if($bilan[$i]['notes'][$j] != "abs"){
				$moyenne[$i] += $bilan[$i]['notes'][$j];
				$nb_presents++;
			}			
		}
		$moyenne[$i] = $moyenne[$i]/$nb_presents;
		$moyenne[$i] = number_format($moyenne[$i], 1);		
	}	

	require("vue/prof/bilan_session.tpl");
}


function bilan(){
	require ("modele/groupeBD.php");
	require ("modele/testBD.php");
	require ("modele/reponsesBD.php");
	require ("modele/resultatBD.php");

	

	//On récup les questions à afficher
	$questions_bilan = get_questions_test();

	if(count($questions_bilan) == 0){
		header("Location:index.php?controle=prof&action=bureau_questions");
	}

	//On récup les étudiants
	$eleves = get_eleves_groupe(get_groupe($_SESSION['groupe']));

	//On récup le nombre d'étudiants par un count du tableau des etudiants
	$nb_etudiants = count($eleves);

	//Le tableau qui va stocker les résultats par élève et par question
	$resultats = array();

	//Le tableau des notes des élèves
	$notes = array();


	//1ere boucle sur le nombre d'élèves pour indexer par élèves
	for ($i=0; $i < count($eleves) ; $i++) { 
		//2eme boucle sur le nombre de questions pour indexer par question

		$notes[$i]['quest'] = 0;
		$note_max = 0;

		for ($j=0; $j < count($questions_bilan) ; $j++) {

			//On récupère les réponses à la question j
			$rep = get_reponses($questions_bilan[$j]['id_quest']);

			$note_question = 0;

			//Pour chaque réponse k à la question j, on check dans la table résultat si l'étudiant i l'a donnée
			//Pour ca on appelle la fonction a_rep qui prend en paramètre l'id de l'élève i et l'id de la reponse k
			for($k=0; $k < count($rep); $k++){

				//Si la réponse est bonne
				if($rep[$k]['bvalide']){
					//Si c'est une question multiple
					if($questions_bilan[$j]['bmultiple']){
						$note_max += 1/count($rep);
					}else{
						$note_max += 1;
					}
				}



				//Si l'élève a donne la reponse k
				if(a_rep($eleves[$i]['id_etu'], $rep[$k]['id_rep'])){
					//On regarde si la reponse était bonne
					if($rep[$k]['bvalide']){
						//Si oui, l'élève i a donné une bonne reponse (la k) à la question j
						$resultats[$i][$j][$k] = 'good';
						if($questions_bilan[$j]['bmultiple']){
							$note_question += 1/count($rep);
						}else{
							$note_question += 1;
						}
					}else{
						//Sinon, l'élève i a donné une mauvaise reponse reponse (la k) à la question j
						$resultats[$i][$j][$k] = 'bad';
						if($questions_bilan[$j]['bmultiple']){
							$note_question -= 1/count($rep);
						}
					}
				}else{
					//Si l'élève i n'a pas donné la réponse k à la question j
					$resultats[$i][$j][$k] = 'no_rep';
				}
			}

			if($note_question >= 0){
				$notes[$i]['quest'] += $note_question;
			}
		}
		$notes[$i]['20'] = number_format(($notes[$i]['quest']/$note_max)*20, 1) ;
		$notes[$i]['quest'] = number_format($notes[$i]['quest'], 1) ;


	}
	$moyenne = 0;
	for($i=0; $i < count($notes); $i ++){
		$moyenne += $notes[$i]['20'];
	}

	$moyenne = $moyenne/count($notes);
	$moyenne = number_format($moyenne, 1);


	$_SESSION['eleves'] = $eleves;
	$_SESSION['notes'] = $notes;
	require ("vue/prof/bilan.tpl");
}


?>

	