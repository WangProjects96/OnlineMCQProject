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
		<a href="index.php?controle=eleve&action=menu"><h3>< Retour</h3></a>
		<table id="bilan">
			<thead>
				<tr>
					<th>Session</th>
					<th>Thème</th>
					<th>Note</th>
				  </tr>
			</thead>
			<tbody>
				<?php
					for($i=0; $i<count($sessions);$i++){
						echo '<tr>';
							echo '<td>' . $sessions[$i]['titre_sess'] . '</td>';
							echo '<td>' . $themes[$i]['descr_theme'] . '</td>';
							echo '<td>' . $bilan[$i]. '</td>';
						echo '</tr>';
							echo '<tr>';
							echo '<td>Moyenne :</td>';
							echo '<td>' . $moyenne[$i] . ' / 20</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>	
	</body>
	<!-- <script type="text/javascript">
		$(document).ready(function() {
			$(function(){
				$('#bilan').tablesorter(); 
			});
		});
	</script> -->
</html>