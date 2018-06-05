<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/bilan_s.css" rel="stylesheet">
	<body>
		<header>
			<a href="index.php?controle=prof&action=menu"><h1 id="titre" class="bleu">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>		
		</header>
		<h2>Selectionnez les questions</h2></br>
		<a href="index.php?controle=prof&action=retourSelection"><h3>Session : <?php echo '' . $_SESSION['session']?></h3></a></br>
		<h3>Groupe : <?php echo $_SESSION['groupe']?></h4></br>	
		<a href="index.php?controle=prof&action=bureau"><h3>< Retour</h3></a>
		<a href="index.php?controle=prof&action=bilan"><h5>Voir les résultats ></h5></a>	
		<table id="bureau">
			<thead>
				<tr>
					<th class="question">Question</th>
					<th class="bouton"></th>
					<th class="eleves">Restants</th>
					<th class="texte"><?php echo 'Thème : ' . $_SESSION['theme']?></th>
					<th class ="resultats">Résultats</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					for($i=0;$i<count($questions);$i++){
						echo '<tr>';
							echo '<td class="question">';
								if(isset($_SESSION['questions'][$questions[$i]['id_quest']]) && $_SESSION['questions'][$questions[$i]['id_quest']] == "presse"){
									echo '<a href="index.php?controle=questions&action=annuler&param=' . $questions[$i]['id_quest'] . '"><input class ="presse" type="button" value="' . $questions[$i]['titre'] . '" /></a> ';
								//si grisé
								}else if(isset($_SESSION['questions'][$questions[$i]['id_quest']]) && $_SESSION['questions'][$questions[$i]['id_quest']] == "gris"){ //si la question est terminée
									echo '<input class="gris" type="button" value="' . $questions[$i]['titre'] . '" />';
								//si annulé
								}else if(isset($_SESSION['questions'][$questions[$i]['id_quest']]) && $_SESSION['questions'][$questions[$i]['id_quest']] == "annule"){
									echo '<input class="annule" type="button" value="' . $questions[$i]['titre'] . '" />';
								}else{//dans le acs ou ni pressé ni grisé
									echo '<a href="index.php?controle=questions&action=autoriser&param=' . $questions[$i]['id_quest'] . '"><input type="button" value="' . $questions[$i]['titre'] . '" /></a> ';
								}
							echo '</td>';
							echo '<td class="bouton">';
								if(isset($_SESSION['questions'][$questions[$i]['id_quest']]) && $_SESSION['questions'][$questions[$i]['id_quest']] == "presse"){
									echo '<a href="index.php?controle=questions&action=fin&param=' . $questions[$i]['id_quest'] . '"><input type="button" value="Fin" /></a> ';
								}
							echo '</td>';
							echo '<td class="eleves">' . $nb_restant[$i] . '</td>';
							if($questions[$i]['bmultiple']){
								echo '<td class="texte">QCM - ' . $questions[$i]['texte'] . '</td>';
							}else{
								echo '<td class="texte">' . $questions[$i]['texte'] . '</td>';
							}

							
							echo '<td class="resultats">';
								echo '<table class="petit"><tr>';
									for($j=0; $j<count($reponses[$i]);$j++){
										if ($reponses[$i][$j]['bvalide']) {
											echo '<td class="vrai">' . $resu[$i][$j] . '</td>';
										}else{
											echo '<td class="faux">' . $resu[$i][$j] . '</td>';
										}												
									}
								echo'</tr></table>';
							echo '</td>';
						echo'</tr>';
					}
				?>
			</tbody>
		</table>
		<!--<?php echo '<div id="m">' . $message_erreur . '</div>';?>-->	
	</body>
</html>