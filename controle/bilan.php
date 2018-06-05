<?php 

function enregistrer_resu(){
	require ("modele/bilanBD.php");
	require ("modele/eleveBD.php");		
	if(isset($_SESSION['eleves'])){
		for($i=0; $i<count($_SESSION['eleves']);$i++){
			if(a_repondu($_SESSION['eleves'][$i]['id_etu'])){
				enregistrer_resultat($_SESSION['eleves'][$i]['id_etu'], $_SESSION['notes'][$i]['20']);
			}else{
				enregistrer_resultat($_SESSION['eleves'][$i]['id_etu'], -1);
			}
		}
	}
	header("Location:index.php?controle=prof&action=retourMenu");
}

?>

