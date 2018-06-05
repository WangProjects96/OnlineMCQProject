<?php
/*Fonctions-modèle réalisant les requètes de gestion des utilisateurs en base de données*/

// verif_ident : fonction booléenne de vérification de l'utilisateur en base de données 
// Si ok, alors le profil de l'utilisateur, à savoir son enregistrement, est affecté en sortie à $profil
function verif_ident($log, $password, &$profil) {
	require ("modele/connectBD.php") ; 
	$link = mysqli_connect($hote, $login, $pass) 
		or die ("erreur de connexion :" . mysql_error()); 
	mysqli_select_db($link, $bd) 
		or die (utf8_encode("erreur d'accès à la base :") . $bd);
	
	$select_etu = "select * from etudiant where login_etu='%s' and pass='%s'"; 
	$req_etu = sprintf($select_etu, $log, $password);
	
	$res_etu = mysqli_query($link, $req_etu)	
		or die (utf8_encode("erreur de requête : ") . $req_etu);
		
	$select_prof = "select * from professeur where login='%s' and pass='%s'"; 
	$req_prof = sprintf($select_prof, $log, $password);
	
	$res_prof = mysqli_query($link, $req_prof)
		or die (utf8_encode("erreur de requête : ") . $req_prof); 

	if (mysqli_num_rows ($res_etu) > 0) {
		$f = utf8_encode('Résultat de la base : <br/>');
		$profil = mysqli_fetch_assoc($res_etu);
		return true;
	}else if(mysqli_num_rows ($res_prof) > 0){
		$f = utf8_encode('Résultat de la base : <br/>');
		$profil = mysqli_fetch_assoc($res_prof);
		return true;
	}
	return false;
}



/* 
Exemple d'affichage de tableau $profil
echo ('<br /> dans verif_ident : <br /><pre>'); 
print_r ($profil); 
echo ('</pre><br />'); 
*/
// ou bien
/*
var_dump($profil); echo ('<br/><br/>'); 
*/
?>