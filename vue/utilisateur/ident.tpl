<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/form.css" rel="stylesheet">
	<body>
		<header>
			<h1 id="titre" class="accueil">QCM LIVE</h1>
		</header>
		<form action="index.php?controle=utilisateur&action=ident" method="post">
			<div class="form_groupe">      
				<input name="nom" type="text" value="<?php echo $nom; ?>" required>
				<span class="bare"></span>
				<label>Identifiant</label>
			</div>
			<div class="form_groupe">      
				<input name= "password" type="password" value="<?php echo $password; ?>" required>
				<span class="bare"></span>
				<label>Mot de passe</label>
			</div>	
			<input type="submit" value="Connexion" />			
			<div id ="m"> <?php echo $msg; ?> </div>
		</form>			
	</body>
</html>