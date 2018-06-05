<html>
	<link href="vue/StyleCSS/main.css" rel="stylesheet">
	<link href="vue/StyleCSS/qcm.css" rel="stylesheet">
	<body>
		<header>
			<a href="index.php?controle=eleve&action=menu"><h1 id="titre" class="blanc">QCM LIVE</h1></a>
			<div id="deconnexion">
				<?php echo '<a href="index.php?controle=utilisateur&action=deconnexion"><input type="button" value="' . $_SESSION['profil']['nom'] . ' ' . $_SESSION['profil']['prenom'] . '" /></a>';?>
			</div>		
		</header>
			<table id="qcm">
				<thead>
					<tr>
						<td class="question">Question</td>
						<td class="texte"><?php echo 'Thème : ' . $_SESSION['theme']['descr_theme']?></td>
						<td class="valider"><?php echo $_SESSION['session'] ?></td>
					</tr>
				</thead>
				<tbody>
					<?php 
						for($i=0;$i<count($questions);$i++){
							echo '<form action="index.php?controle=reponses&action=valider&param=' . $questions[$i]['id_quest'] . '" method="post">';

								echo '<tr class="q">';
									if($questions[$i]['bmultiple']){
										echo '<td class="question">' . $questions[$i]['titre'] . ' - QCM</td>';
									}else{
										echo '<td class="question">' . $questions[$i]['titre'] . '</td>';
									}
									if(isset($_SESSION['valider'][$questions[$i]['id_quest']]) && $_SESSION['valider'][$questions[$i]['id_quest']]){
										echo '<td class="gris" class="texte">' . $questions[$i]['texte'] . '</td>';
									}else{
										echo '<td class="texte">' . $questions[$i]['texte'] . '</td>';
									}							
									echo '<td class="valider">';
										if(isset($_SESSION['valider'][$questions[$i]['id_quest']]) && $_SESSION['valider'][$questions[$i]['id_quest']]){
											echo' <input type="submit" value="Valider" class="valide" />';
										}else{
											echo' <input type="submit" value="Valider" class="nonValide" />';
										}
									echo '</td>';
								echo'</tr>';

								for($j=0; $j<count($reponses[$i]);$j++){
									echo '<tr>';
										echo '<td class="question"></td>';
										if($questions[$i]['bmultiple']){

											if(isset($_SESSION['valider'][$questions[$i]['id_quest']]) && $_SESSION['valider'][$questions[$i]['id_quest']]){
												echo '<td class="texte"><input disabled="true" type="checkbox" name="resu[]" value="' . $reponses[$i][$j]['id_rep'] . '"/>' . $reponses[$i][$j]['texte_rep'] .'</td>';
											}else{
												if($j==0){
													echo '<td class="texte"><input type="checkbox" checked="checked" name="resu[]" value="' . $reponses[$i][$j]['id_rep'] . '"/>' . $reponses[$i][$j]['texte_rep'] .'</td>';
												}else{
													echo '<td class="texte"><input type="checkbox" name="resu[]" value="' . $reponses[$i][$j]['id_rep'] . '"/>' . $reponses[$i][$j]['texte_rep'] .'</td>';
												}
												
											}
											
										}else{

											if(isset($_SESSION['valider'][$questions[$i]['id_quest']]) && $_SESSION['valider'][$questions[$i]['id_quest']]){								
												echo '<td class="texte"><input disabled="true" type="radio" name="resu[]" value="' . $reponses[$i][$j]['id_rep'] . '"/>' . $reponses[$i][$j]['texte_rep'] .'</td>';
											}else{
												if($j==0){
													echo '<td class="texte"><input type="radio" checked="checked" name="resu[]" value="' . $reponses[$i][$j]['id_rep'] . '"/>' . $reponses[$i][$j]['texte_rep'] .'</td>';
												}else{
													echo '<td class="texte"><input type="radio" name="resu[]" value="' . $reponses[$i][$j]['id_rep'] . '"/>' . $reponses[$i][$j]['texte_rep'] .'</td>';
												}
												
											}
											
										}

										


										echo '<td class="valider"></td>';
									echo'</tr>';
								}
							 echo '</form>';
						}
					?>
				</tbody>
			</table>
		</div>				
	</body>
	<footer>
		<a href="index.php?controle=eleve&action=bilan_eleve"><input type="button" value="Bilan" /></a>
	</footer>
</html>