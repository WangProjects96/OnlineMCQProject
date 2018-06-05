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
		<a href="index.php?controle=prof&action=menu"><h3>< Retour</h3></a>
			<table>
				<?php
					for($i=0; $i<count($sessions);$i++){
						echo '<thead>';
							echo '<tr>';
								echo '<th>Session : ' . $sessions[$i]['titre_sess'] . '</th>';
								echo '<th>Theme : ' . $themes[$i]['descr_theme'] . '</th>';
								echo '<th>Groupe : ' . $groupes[$i]. '</th>';
							echo '</tr>';
						echo '</thead>';
						for($j=0; $j<count($bilan[$i]['etudiants']);$j++){
							echo '<tr>';
								echo '<td>' . $bilan[$i]['etudiants'][$j]['nom'] . '</td>';
								echo '<td>' .  $bilan[$i]['notes'][$j]  . '</td>';
							echo '</tr>';
						}
						echo '<tr>';
							echo '<td>Moyenne :</td>';
							echo '<td>' . $moyenne[$i] . ' / 20</td>';
						echo '</tr>';
					}

				?>
			</table>		
		</div>			
	</body>
</html>