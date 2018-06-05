<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/bilan_s.css" rel="stylesheet">
	<body>
		<header>
		<a href="index.php?controle=eleve&action=menu"><h1 id="titre" class="blanc">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>		
		</header>
		<h2>Bilan</h2></br>
		<a href="index.php?controle=eleve&action=bureau"><h3>< Retour</h3></a>
		<table>
			<thead>
				<tr>
					<th class="etudiants">Prénom</th>
					<th class="notes">Notes</th>
					<th class="finale">Finale</th>
					<?php  
						for($i=0; $i<count($questions_bilan);$i++){
							echo '<th class="question">Q '. $questions_bilan[$i]['titre'] . '</th>';
						}
					?>					
				</tr>
			</head>
			<tbody>
				<?php 
					echo '<tr>';
						echo '<td class="etudiants">'. $_SESSION['profil']['nom'] . '</td>';
						echo '<td class="notes">'. $notes['quest'] . '</td>';
						echo '<td class="finale">' . $notes['20'] . '</td>';
						for($i=0; $i < count($questions_bilan); $i++){
							echo '<td>';
								echo '<table class="petit"><tr>';
									for($j=0; $j < count($resultats[$i]); $j++){
										if($resultats[$i][$j] == 'good'){
											echo '<td class="vrai"> X </td>';
										}else if($resultats[$i][$j] == 'bad'){
											echo '<td class="faux"> X </td>';
										}else{
											echo '<td class="no_rep"> X </td>';
										}
									}
								echo '</tr></table>';
							echo '</td>';
						}
					echo '</tr>';
				?>
			</tbody>
		</table>		
	</body>
</html>