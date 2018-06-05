<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/form.css" rel="stylesheet">
	<body>
		<header>
			<a href="index.php?controle=prof&action=menu"><h1 id="titre" class="bleu">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>		
		</header>
		<a href="index.php?controle=prof&action=menu"><h3>< Menu principal</h3></a>
		<form action="index.php?controle=session&action=lancer" method="post">
			<h1 id="form_titre">Lancez une session de test</h1>
			<div class="form_groupe">
				<input type="text" name="session" required>
				<span class="bare"></span>
				<label>Titre</label>
			</div>
			<div class="form_groupe">
				<select name="theme" required>
					<option selected disabled></option>
					<?php					
						for($i=0;$i<count($themes);$i++){
							echo'<option>' . $themes[$i]['descr_theme']. '</option>';
						}
					?>
				</select>
				<span class="bare"></span>
				<label>Thème</label>
			</div>
			<div class="form_groupe">
				<select name="groupe" required>
					<option selected disabled></option>
					<?php					
						for($i=0;$i<count($groupes);$i++){
							echo'<option>' . $groupes[$i]['num_grpe']. '</option>';
						}
					?>
				</select>
				<span class="bare"></span>
				<label>Groupe</label>
			</div>
			<input type="submit" value="Lancer le test" />
		</form>				
	</body>
</html>