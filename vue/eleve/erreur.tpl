<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/erreur.css" rel="stylesheet">
	<body>
		<header>
			<a href="index.php?controle=eleve&action=menu"><h1 id="titre" class="blanc">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>
		</header>
		<h2>Répondez aux questions</h2></br>
		<a href="index.php?controle=eleve&action=menu"><h3>< Retour</h3></a>
		<div id="erreur">
			Oups ! </br>
			Le test n'a pas encore commencé.
		</div>				
	</body>
</html>