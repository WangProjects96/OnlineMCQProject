<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/bilan_s.css" rel="stylesheet">
	<header>
		<a href="index.php?controle=prof&action=menu"><h1 id="titre" class="bleu">QCM LIVE</h1></a>
		<div id="deconnexion">
			<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
		</div>		
	</header>
	<a href="index.php?controle=prof&action=retourSelection"><h3>Session : <?php echo '' . $_SESSION['session']?></h3></a></br>
	<h3>Groupe : <?php echo $_SESSION['groupe']?></h4>
	<body>
		<table id="bureau">
			<thead>
				<tr>
					<th class="question">Question</th>
					<th class="texte"><?php echo 'Thème : ' . $_SESSION['theme']?></th>
					<th class="reponses"><a href="index.php?controle=reponses&action=afficher"><input id="reponses" type="button" value="Réponses" /></a></th>
				  </tr>
			</thead>
			<tbody>
				<?php 
					for($i=0;$i<count($questions);$i++){
						echo '<tr>';
							echo '<td class="question">' . ($i + 1) . '</td>';
							echo '<td class="texte">' . $questions[$i]['texte'] . '</td>';
							echo '<td class="reponses">';
						

							if(isset($_SESSION['reponses']) && $_SESSION['reponses']){

								echo '<table class="petit"><tr>';
									for($j=0; $j<count($reponses[$i]);$j++){
										if ($reponses[$i][$j]['bvalide']) {
											echo '<td class="vrai"> X </td>';
										}else{
											echo '<td class="faux"> X </td>';
										}


									}
								echo'</tr></table>';

							}
							echo'</td>';
						echo'</tr>';
					}
				?>
			</tbody>	
		</table>
		<div id="bas">
			<a href="index.php?controle=prof&action=ajout_questions&param=bureau"><input id="questions" type="button" value="Ajouter question(s)" /></a>
			<a href="index.php?controle=prof&action=ajout_reponses&param=bureau"><input id="reponses" type="button" value="Ajouter reponse(s)" /></a>
			<a href="index.php?controle=prof&action=bureau_questions"><input id="lancer" type="button" value="Lancer le test" /></a>
		</div>
	</body>
</html>