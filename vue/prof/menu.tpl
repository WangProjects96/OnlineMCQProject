<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/menu.css" rel="stylesheet">
	<body>
		<header>
			<a href="index.php?controle=prof&action=menu"><h1 id="titre" class="bleu">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>		
		</header>
		<h2>Menu principal</h2>
		<div id ="conteneur">
			<a href="index.php?controle=prof&action=selection">
				<div class="bouton prem">
					<h3>Démarrer un test</h3>
				</div>
			</a>
			<a href="index.php?controle=prof&action=ajout_questions&param=menu">
				<div class="bouton">
					<h3>Ajouter une question</h3>
				</div>
			</a>
			<a href="index.php?controle=prof&action=ajout_reponses&param=menu">
				<div class="bouton">
					<h3>Ajouter une réponse</h3>
				</div>
			</a>
			<a href="index.php?controle=prof&action=bilan_sessions_prec">
				<div class="bouton">
					<h3>Bilan des sessions</h3>
				</div>
			</a>
		</div>			
	</body>
</html>