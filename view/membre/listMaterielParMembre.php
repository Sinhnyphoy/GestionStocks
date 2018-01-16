    <section class="content-inner">
	<div class="page-header">
		<h2>Liste des matériels d'un membre</h2>
	</div>
			
	<span class="message"><?php if (isset($message)) echo $message; ?></span>		
	
	<div class="container-fluid">
<?php	
	if (!empty($tab_membre)) {
		
		echo "<p class='h3'>";
			echo "<span class='label label-info'>NNI : " . $tab_membre[0]->NNI . "</span>";
		echo "</p>";
		echo "<p class='h3'>";
			echo "<span class='label label-info'>Nom et prénom du membre : " . $tab_membre[0]->membre_nom . "	" . $tab_membre[0]->membre_prenom . "</span>";
		echo "</p>";
		
	}
?>
	</div>
	
	<div class="table-wrapper-2">
	<table class="table table-hover table-responsive ">
		<thead>
			<tr>
			  <th scope="col">Nom du matériel</th>
			  <th scope="col">Quantité matériel</th>
			  <th scope="col">Date</th>
			  <th scope="col">Quantité Stock</th>
			  <th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
		
<?php
	if (!empty($tab_appartenir)) {

		foreach ($tab_appartenir as $appartenir) {		
			echo "<tr>";
			echo "<td style='display: none;'>" . $appartenir->materiel_id . "</td>";
			echo "<th>" . $appartenir->materiel_nom . "</th>";				
			echo "<td>" . $appartenir->sum_qte . "<button data-toggle='modal' data-placement='right' data-target='#story' data-nni='" .$tab_membre[0]->NNI. "' data-id='" . $appartenir->materiel_id . "' 
					title='Histoire matériel affecté' id='getId' class='btn btn-link'></button></td>";	
			echo "<td>" . $appartenir->max_date . "</td>";
			echo "<td>" . $appartenir->quantite_restante . "</td>";
			echo "<td><a data-toggle='modal' data-main-id='" . $appartenir->max_id . "' data-id='" . $appartenir->materiel_id . "' data-nom='" . $appartenir->materiel_nom . "'  
						data-qte-stock='" . $appartenir->quantite_restante . "' title='Add matériel affecté' class='open-AddMaterielDialog btn btn-primary' href='#addMaterielDialog'>
						<span class='glyphicon glyphicon-plus'></span>	Ajouter</a></td>";	
			echo "</tr>";
			echo "</form>";
		}		
	} else
		echo "<div class='alert alert-info' role='alert'>Aucun produit n'est enregistré dans la base de données</div>";

?>

		</tbody>
	</table>
	</div>
	
	<!-- Modal #Story -->
	<div id="story" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog"> 
		 <div class="modal-content">  
	   
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
				<p class="h3 modal-title" id="myModalLabel">
				   <i class="glyphicon glyphicon-time"></i> Histoire
				</p> 
			</div> 
			   
			<div class="modal-body">       
			   <!-- mysql data will be load here -->                          
			   <div id="dynamic-content"></div>
			</div>
			
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
			</div> 
		</div> 
	  </div>
	</div>
	
	
	<!-- Modal #EditCommentDialog -->
	<form class='form-vertical' method='post' action='index.php?controller=membre&action=saveComment'>
	  <div id="editCommentDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		
		  <!-- Modal content -->
		  <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			  <p class="h3 modal-title" id="myModalLabel">Modifier le commentaire</p>
			</div>
			<div class="modal-body">
				<div id="dynamic-content-2"></div>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span>Enregistrer</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
			</div>
		  </div>
		  
		</div>
	  </div>
	</form>
	
		
	<!-- Modal #AddMaterielDialog -->
	<div class="modal fade" id="addMaterielDialog" tabindex="-1" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content -->
		  <div class="modal-content">
			<form method="post" action="index.php?controller=membre&action=addition">
				<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <p class="h3 modal-title">Ajouter</p>
			</div>
			
			<div class="modal-body">				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-nni">NNI :</span>
						<input type='text' class='form-control' name='NNI' aria-describedby='addon-nni' value="<?php echo $tab_membre[0]->NNI ?>" readonly>
					</div>
				</div>
				
				<div class="form-group hide">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-id">Id du matériel :</span>
						<input type='text' class='form-control' name='materiel_id' aria-describedby='addon-id' id="materiel_id">
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-nom">Nom du matériel :</span>
						<input type='text' class='form-control' name='materiel_nom' aria-describedby='addon-nom' id="materiel_nom" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-quantite-materiel">Quantité du matériel :</span>
						<input class="form-control " type="text" name='quantite_materiel' aria-describedby='addon-quantite-materiel' placeholder="Quantité à ajouter" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-date">Date :</span>
						<input class="form-control " type="text" name='date' aria-describedby='addon-date' placeholder="YYYY/MM/DD" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-quantite-stock">Quantité dans stock :</span>
						<input class="form-control " type="text" name='quantite_restante' aria-describedby='addon-quantite-stock' id="quantite_restante" placeholder="Stock" readonly>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-comment">Commentaire :</span>
						<textarea class="form-control " type="text" name='commentaire' aria-describedby='addon-comment' rows="3"></textarea>
					</div>
				</div>
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