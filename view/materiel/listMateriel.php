    <section class="content-inner">
	<div class="page-header">
		<h2>Liste des matériels</h2>
	</div>
	
	<span class="message"><?php if (isset($message)) echo $message; ?></span>
	
	<div class="table-wrapper">
	<table class="table table-hover table-responsive table-striped table-fixed">
		<thead>
			<tr>
			  <th scope="col" style="display: none;">Id du matériel</th>
			  <th scope="col">Nom du matériel</th>
			  <th scope="col">Quantité restante</th>
			  <th scope="col">Seuil bas</th>
			  <th scope="col">Commandé</th>
			  <th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
<?php
        if (!empty($tab_materiel)) {

			foreach ($tab_materiel as $materiel) {	
				echo "<tr>";
				echo "<td style='display: none;'>" . $materiel->materiel_id . "</td>";
				echo "<th scope='row'>" . $materiel->materiel_nom . "</th>";
				echo "<td>" . $materiel->quantite_restante . "</td>";
				echo "<td>" . $materiel->seuil_bas . "</td>";
				
				if($materiel->commandé == 1) {
					if($materiel->quantite_restante <= $materiel->seuil_bas) {
						echo "<td><font color='red'>Non</font></td>";
					} else {
						echo "<td>Non</td>";
					}
				} else {
					echo "<td>Oui</td>";
				}
				echo "<td><button data-toggle='modal' data-target='#editMaterielDialog' data-id='" . $materiel->materiel_id . "' title='Modifier un matériel' id='getMaterielId' class='btn btn-primary'>
						<span class='glyphicon glyphicon-edit'></span>	Modifier</button></td>";	
				echo "</tr>";
			}
		} else {
			echo "<div class='alert alert-info' role='alert'>Aucun matériel n'est enregistré dans la base de données</div>";
		}
?>

		</tbody>
	</table>
	</div>
	
	
	<!-- Modal -->
	  <div class="modal fade" id="editMaterielDialog" tabindex="-1" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content -->
		  <div class="modal-content">
		  <form method="post" action="index.php?controller=materiel&action=modify">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <p class="h3 modal-title"><span class='glyphicon glyphicon-edit'></span>	Modifier un matériel</p>
			</div>
			
			<div class="modal-body">
				<div id="dynamic-content-edit"></div>
			</div>
			
			<div class="modal-footer">
			<button type="submit" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-ok-sign"></span>Enregistrer</button>
			  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
			</div>
			</form>
		  </div>
		  
		</div>
	  </div> 
	
    </section>
  </div>
</div>