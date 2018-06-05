<?php 


function bureau(){
	require("modele/testBD.php");
	require("modele/questionsBD.php");
	require ("modele/reponsesBD.php");
	require ("modele/sessionBD.php");
	require ("modele/resultatBD.php");
	
	if(test_commence($_SESSION['profil'])){
		$questions = get_questions_auto();
		$reponses = array();
		for($i=0;$i<count($questions);$i++){
			$reponses[] = get_reponses($questions[$i]['id_quest']);
		}
		$profil = $_SESSION['profil'];
		session_destroy();
		session_start();
		$_SESSION['profil'] = $profil;
		$_SESSION['theme'] = get_theme($questions[0]['id_theme']);
		$_SESSION['session'] = get_session($questions[0]['id_quest']);
		$resu = get_res($_SESSION['profil']['id_etu']);
		for($i=0; $i<count($resu); $i++){
			$_SESSION['valider'][$resu[$i]['id_quest']] = true;
		}
		require("vue/eleve/bureau.tpl");
	}else{
		require("vue/eleve/erreur.tpl");
	}	
}

function menu(){
	require("vue/eleve/menu.tpl");
}


function bilan_eleve(){
	require ("modele/groupeBD.php");
	require ("modele/testBD.php");
	require ("modele/reponsesBD.php");
	require ("modele/resultatBD.php");

	//On récupère les questions ppour l'affichage 
	$questions_bilan = get_questions_test();


	//résultats par question
	$resultats = array();

	//Le tableau des notes de élève
	$notes['quest'] = 0;
	$note_max = 0;
	
	//boucle sur le nombre de questions pour indexer par question
	for ($i=0; $i < count($questions_bilan) ; $i++) {

			//On récupère les réponses à la question i
			$rep = get_reponses($questions_bilan[$i]['id_quest']);

			$note_question = 0;

			//Pour chaque réponse j à la question i, on check dans la table résultat si l'étudiant l'a donnée
			//Pour ca on appelle la fonction a_rep qui prend en paramètre l'id de l'élève et l'id de la reponse j
			for($j=0; $j < count($rep); $j++){

				//Si la réponse est bonne
				if($rep[$j]['bvalide']){
					//Si c'est une question multiple
					if($questions_bilan[$i]['bmultiple']){
						$note_max += 1/count($rep);
					}else{
						$note_max += 1;
					}
				}

				//Si l'élève a donne la reponse j
				if(a_rep($_SESSION['profil']['id_etu'], $rep[$j]['id_rep'])){
					//On regarde si la reponse était bonne
					if($rep[$j]['bvalide']){
						//Si oui, l'élève a donné une bonne reponse (la j) à la question i
						$resultats[$i][$j] = 'good';
						if($questions_bilan[$i]['bmultiple']){
							$note_question += 1/count($rep);
						}else{
							$note_question += 1;
						}
					}else{
						//Sinon, l'élève a donné une mauvaise reponse reponse (la j) à la question i
						$resultats[$i][$j] = 'bad';
						if($questions_bilan[$i]['bmultiple']){
							$note_question -= 1/count($rep);
						}
					}
				}else{
					//Si l'élève n'a pas donné la réponse j à la question i
					$resultats[$i][$j] = 'no_rep';
				}
			}

			if($note_question >= 0){
				$notes['quest'] += $note_question;
			}
		}
		
		$notes['20'] = number_format(($notes['quest']/$note_max)*20, 1) ;
		$notes['quest'] = number_format($notes['quest'], 1) ;
		require ("vue/eleve/bilan.tpl");
}

function bilan_sessions_prec(){
	require ("modele/groupeBD.php");
	require ("modele/sessionBD.php");
	require ("modele/bilanBD.php");
	//On récup les sesions précédentes
	$sessions = get_sessions();
	//On va le remplir avec le thème de chaque session
	$themes = array();

	$bilan = array();

	$moyenne = array();

	for ($i=0; $i < count($sessions) ; $i++){
		$themes[$i] = get_theme($sessions[$i]['id_theme']);
		if(get_note($_SESSION['profil']['id_etu'], $sessions[$i]['id_session']) == -1){
			$bilan[$i] = "abs";
		}else{
			$bilan[$i] = get_note($_SESSION['profil']['id_etu'], $sessions[$i]['id_session']);
		}

		$notes = get_notes_session($sessions[$i]['id_session']);
		$moyenne[$i] = 0;
		$nb_presents = 0;

		for($j=0;$j<count($notes);$j++){
			if($notes[$j] != -1){
				$moyenne[$i] += $notes[$j];
				$nb_presents++;
			}
		}

		$moyenne[$i] = $moyenne[$i]/$nb_presents;
		$moyenne[$i] = number_format($moyenne[$i], 1);	

	}

	
	require("vue/eleve/bilan_session.tpl");
}




?>

