    <section class="content-inner">
	<div class="page-header">
		<h2>Liste des matériels de prêt</h2>
	</div>
	
	<span class="message"><?php if (isset($message)) echo $message; ?></span>
	
	<form class="form-vertical" method="post" action="index.php?controller=materielPret&action=searchById">
	<table class="table table-hover table-responsive ">
		<thead>
			<tr>
			  <th scope="col">Identifiant</th>
			  <th scope="col">Désignation</th>
			  <th scope="col">Commentaire</th>
			  <th scope="col">Disponible</th>
			</tr>
		  </thead>
		  <tbody>
		
<?php
        if (!empty($tab_materiel_pret)) {
			foreach ($tab_materiel_pret as $materiel_pret) {			
				echo "<tr>";
				echo "<th scope='row'><input type='submit' class='btn btn-link' name='materiel_pret_id' value='" . $materiel_pret->materiel_pret_id . "'></th>";
				echo "<td>" . $materiel_pret->designation . "</td>";		
				echo "<td>" . $materiel_pret->commentaire . "</td>";
				if($materiel_pret->disponible == 1) {
					echo "<td><font color='red'>Non</font></td>";
				} else {
					echo "<td>Oui</td>";
				}
				echo "</tr>";
			}
			
		} else
			echo "<div class='alert alert-info' role='alert'>Aucun matériel n'est enregistré dans la base de données</div>";
		
?>

		</tbody>
	</table>
	</form>
    </section>
  </div>  
  
</div>