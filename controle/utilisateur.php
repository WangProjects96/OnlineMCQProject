<?php 

/*controleur utilisateur.php :
  ensemble de fonctions-action de gestion des utilisateurs
*/

function ident () {
	$nom=  isset($_POST['nom'])?($_POST['nom']):'';
	$password=  isset($_POST['password'])?($_POST['password']):'';
	$msg='';
	
	if  (count($_POST)==0) {
			require ("vue/utilisateur/ident.tpl") ;
			}
			else {
				require ("modele/utilisateurBD.php") ;
				if  (! (verifS($nom, $password) && verif_ident($nom, $password, $profil))) {
					$msg ="erreur de saisie";
					require ("vue/utilisateur/ident.tpl");
				}
				else {
					//Si se connecte bien
					$_SESSION['profil'] = $profil;
					//On regarde si c'est un élève ou un prof
					if(isset($profil['login_etu'])){
						header("Location:index.php?controle=eleve&action=menu");
					}else{
						header("Location:index.php?controle=prof&action=menu");
					}				
				}
	}	
}

//a compléter
function deconnexion(){
	//si c'est un étudiant qui se déco
	if(isset($_SESSION['profil']['login_etu'])){
	}else{// si c'est le prof qui se déco
		require ("modele/testBD.php");
		cloturer();
	}
	session_destroy();
	//header pour passer par index.php et faire un session_start()
	header("Location:index.php?controle=utilisateur&action=ident");
}

// verifS : vérification syntaxique des saisies 
function verifS($nom, $num) {
	if (!preg_match("`^[[:alpha:][:digit:]\-]{1,30}$`", $nom)) {
		return false;
		}
	if (!preg_match("`^[[:alpha:][:digit:]]{2,8}$`", $num)) {
		return false;
		}
	return true;
}

