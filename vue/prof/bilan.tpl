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
		<h2>Bilan</h2></br>
		<a href="index.php?controle=prof&action=bureau_questions"><h3>< Retour</h3></a>
		<a href="index.php?controle=bilan&action=enregistrer_resu"><h5>Enregistrer et quitter ></h5></a>
		<table>
			<thead>
				<tr>
					<td class="etudiants"><?php echo 'Etudiants : ' . $nb_etudiants?></td>
					<td class="notes">Notes</td>
					<td class="finale">Finale</td>
					<?php  
						for($i=0; $i<count($questions_bilan);$i++){
							echo '<td class="question">Q '. $questions_bilan[$i]['titre'] . '</td>';
						}
					?>					
				</tr>
			</thead>
			<tbody>
				<?php  
					for($i=0; $i<count($eleves);$i++){
						echo '<tr>';
							echo '<td class="etudiants">'. $eleves[$i]['nom'] . '</td>';
							echo '<td class="notes">'. $notes[$i]['quest'] . '</td>';
							echo '<td class="finale">' . $notes[$i]['20'] . '</td>';
							for($j=0; $j < count($questions_bilan); $j++){
								echo '<td>';
									echo '<table class="petit"><tr>';
										for($k=0; $k < count($resultats[$i][$j]); $k++){
											if($resultats[$i][$j][$k] == 'good'){
												echo '<td class="vrai"> X </td>';
											}else if($resultats[$i][$j][$k] == 'bad'){
												echo '<td class="faux"> X </td>';
											}else{
												echo '<td class="no_rep"> X </td>';
											}
										}
									echo '</tr></table>';
								echo '</td>';
							}
						echo '</tr>';
					}
					echo '<tr>';
						echo '<td>Moyenne :</td>';
						echo '<td>' . $moyenne . ' / 20</td>';
					echo '</tr>';
				?>
			</tbody>
		</table>
	</body>
</html>