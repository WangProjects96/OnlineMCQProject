<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/menu.css" rel="stylesheet">
	<body>
		<header>
			<a href="index.php?controle=eleve&action=menu"><h1 id="titre" class="blanc">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>		
		</header>
		<h2>Menu principal</h2>
		<div id ="conteneur">
			<a href="index.php?controle=eleve&action=bureau">
				<div class="bouton">
					<h3>Démarrer un test</h3>
				</div>
			</a>
			<a href="index.php?controle=eleve&action=bilan_sessions_prec">
				<div class="bouton">
					<h3>Mes bilans</h3>
				</div>
			</a>
		</div>			
	</body>
</html>