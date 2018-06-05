<?php

function a_repondu($id_etu){
	require ("modele/connectBD.php");

	$select = "SELECT * FROM resultat WHERE id_etu = '%d'";
	$req = sprintf($select, $id_etu);
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : ") . $req);
	if (mysqli_num_rows ($res) > 0) {
		return true;
	}
	return false;
}

?>