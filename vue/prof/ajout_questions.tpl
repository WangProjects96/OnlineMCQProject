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
		<?php 
			if($page_prec=="menu"){
				echo'<a href="index.php?controle=prof&action=menu"><h3>< Menu principal</h3></a></br>';
			}else{
				echo '<a href="index.php?controle=prof&action=bureau"><h3>< Retour bureau</h3></a></br>';
			}
		?>
		<form action="index.php?controle=questions&action=confirmer" method="post">
			<h1 id="form_titre">Ajoutez une question</h1>
			<div class="form_groupe">      
				<input name="texte" type="text" value="<?php echo $texte; ?>" required>
				<span class="bare"></span>
				<label>Intitulé</label>
			</div>
			<div class="form_groupe">
				<label class="v">Type de question</label>
				<div class="c_input">
					<input type="radio" checked="checked" name="QCM" value="multiple"/>Question à choix multiple</br>
					<input type="radio" name="QCM" value="unique"/>Question à choix unique</br>
				</div>				
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
			<input type= "submit" value= "Enregistrer la réponse" />			
		</form>
	</body>
</html>