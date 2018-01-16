    <section class="content-inner">
	<div class="page-header">
		<h2>L'histoire du matériel de prêt</h2>
	</div>
	
	<span class="message"><?php if (isset($message)) echo $message; ?></span>
	
	<div class="container-fluid">
<?php	
	if (!empty($tab_materiel_pret)) {
		
		echo "<p class='h3'>";
			echo "<span class='label label-info'>Identifiant : " . $tab_materiel_pret[0]->materiel_pret_id . "</span>";
			echo "<input type='hidden' class='form-control' name='materiel_pret_id' value='".$tab_materiel_pret[0]->materiel_pret_id."'>";
		echo "</p>";
		echo "<p class='h3'>";
			echo "<span class='label label-info'>Nom du matériel de prêt : " . $tab_materiel_pret[0]->designation . "</span>";
			echo "<input type='hidden' class='form-control' name='designation' value='".$tab_materiel_pret[0]->designation."'>";
		echo "</p>";
		
	 
?>
	</div>

	<div class="container-fluid">
	<table class="table table-hover table-responsive">
		<thead>
			<tr>
			  <th scope="col" style='display: none;'>Preter_id</th>
			  <th scope="col">NNI</th>
			  <th scope="col">Nom d'emprunteur</th>
			  <th scope="col">Prénom d'emprunteur</th>
			  <th scope="col">Date d'emprunt</th>
			  <th scope="col">Date de retour</th>
			  <th scope="col">Commentaire</th>
			</tr>
		</thead>
		<tbody>
		
<?php

		foreach ($tab_materiel_pret as $materiel_pret) {
			echo "<tr>";
			echo "<th scope='row' style='display: none;'>" . $materiel_pret->preter_id . "</th>";				
			echo "<td>" . $materiel_pret->NNI . "</td>";				
			echo "<td>" . $materiel_pret->membre_nom . "</td>";
			echo "<td>" . $materiel_pret->membre_prenom . "</td>";
			echo "<td>" . $materiel_pret->date_emprunt . "<input type='hidden' class='form-control' name='date_emprunt' value='" . $materiel_pret->date_emprunt . "'></td>";
			echo "<td>" . $materiel_pret->date_retour . "</td>";
			echo "<td>" . $materiel_pret->commentaire . "</td>";
			echo "</tr>";
		}
	
?>
		</tbody>
	</table>
	
<?php 
		$tabLength = sizeof($tab_materiel_pret);
		$lastDateReturn = $tab_materiel_pret[$tabLength-1]->date_retour;
		$lastPreterId = $tab_materiel_pret[$tabLength-1]->preter_id;
		$lastNNI = $tab_materiel_pret[$tabLength-1]->NNI;
		$lastSurname = $tab_materiel_pret[$tabLength-1]->membre_nom;
		$lastName = $tab_materiel_pret[$tabLength-1]->membre_prenom;
		$lastDateLoan = $tab_materiel_pret[$tabLength-1]->date_emprunt;
		
		if(!empty($lastDateReturn)) {
			echo "<a data-toggle='modal' data-materiel-pret-id='" . $tab_materiel_pret[0]->materiel_pret_id . "' data-designation='" . $tab_materiel_pret[0]->designation . "' data-last-date='" . $lastDateReturn . "' 
					title='enregistrer le nouveau prêt' class='open-NewLoan btn btn-primary btn-lg pull-right' href='#newLoan'>Nouveau Prêt</a>	";
		} else {
			echo "<a data-toggle='modal' title='save return date' class='open-SaveReturnDialog btn btn-primary btn-lg pull-right' href='#saveReturnDialog'>Enregistrer le retour</a>	";
		}
	
	} else {
			echo "<p class='h3'>";
			echo "<span class='label label-info'>Identifiant : " . $materiel_pret_id . "</span>";
			echo "<input type='hidden' class='form-control' name='materiel_pret_id' value='".$materiel_pret_id."'>";
		echo "</p>";
		echo "<p class='h3'>";
			echo "<span class='label label-info'>Nom du matériel de prêt : " . $result_designation[0]->designation . "</span>";
			echo "<input type='hidden' class='form-control' name='designation' value='".$result_designation[0]->designation."'>";
		echo "</p>";
			echo "</div>";
			echo "<div class='alert alert-info' role='alert'>Aucun prêt n'est enregistré dans la base de données</div>";
			
			echo "<a data-toggle='modal' data-materiel-pret-id='" . $materiel_pret_id . "' data-designation='" . $result_designation[0]->designation . "' 
				title='enregistrer le nouveau prêt' class='open-NewLoan btn btn-primary btn-lg pull-right' href='#newLoan'>Nouveau Prêt</a>	";
	}
?>
	</div>
	
	<!-- Modal #NewLoan-->
	<form class="form-vertical" method="post" action="index.php?controller=materielPret&action=saveLoan">
	  <div class="modal fade" id="newLoan" tabindex="-1" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content -->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <p class="h3 modal-title">Ajouter le nouveau prêt</p>
			</div>
			<div class="modal-body">
				<div class="form-group hide">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-materiel_pret_id">Last date :</span>
						<input type='text' class='form-control' name='last_date' aria-describedby='addon-materiel_pret_id' id="last_date" readonly>
					</div>
				</div>
				
				<div class="form-group hide">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-materiel_pret_id">Identifiant du matériel de prêt :</span>
						<input type='text' class='form-control' name='materiel_pret_id' aria-describedby='addon-materiel_pret_id' id="materiel_pret_id" readonly>
					</div>
				</div>
				
				<div class="form-group hide">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-designation">Nom du matériel de prêt :</span>
						<input type='text' class='form-control' name='designation' aria-describedby='addon-designation' id="designation" readonly>
					</div>
				</div>
			
				<fieldset class="box-border">
				<legend class="box-border">Information de l'emprunteur :</legend>
					<div class="row">
					<div class="col-10">
						<select name="info" class="form-control selectpicker" data-live-search="true" required>
							<?php
								require_once File::build_path(array('model', 'ModelMembre.php'));
								$tab_membre = ModelMembre::selectAll();
								if (!empty($tab_membre)) {
									foreach ($tab_membre as $membre) {?>	
										<option>
										<?php 
											echo $membre->NNI;
											echo " | ";
											echo $membre->membre_nom;
											echo " | ";
											echo $membre->membre_prenom;
										?>
										</option>
									<?php 
									}
								} 
							?> 
						</select>
					</div>
					</div><br>
					<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addMemberModal">Ajouter membre</button>
				</fieldset>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-date-loan">Date d'emprunt:</span>
						<input class="form-control " type="text" name='date' aria-describedby='addon-date-loan' id="date_emprunt"  placeholder="YYYY-MM-DD" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-commantaire">Commentaire:</span>
						<textarea name="commentaire" class="form-control" rows="3" aria-describedby='addon-commentaire'></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-ok-sign"></span>Enregistrer</button>
			  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
			</div>
			
		  </div>
		  
		</div>
	  </div>
	</form>	
	  
	<!-- Modal #AddMemberModal-->
	<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog">
     <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
		
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="h3 modal-title">
		  <i class="glyphicon glyphicon-user"></i>	Ajouter un membre
		  </p>
        </div>
        <div class="modal-body">
			<p class="statusMsg"></p>
			<form role="form">
				<div class="form-group">
					<div class="input-group input-group-lg">
					  <span class="input-group-addon" id="addon-nni">NNI :</span>
					  <input type="text" class="form-control" name="NNI" aria-describedby="addon-nni" id="inputNNI" placeholder="Entrer le NNI">
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
					  <span class="input-group-addon" id="addon-nom">Nom :</span>
					  <input type="text" class="form-control" name="membre_nom" aria-describedby="addon-nom" id="inputSurname" placeholder="Entrer son nom">
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
					  <span class="input-group-addon" id="addon-prenom">Prénom :</span>
					  <input type="text" class="form-control" name="membre_prenom" aria-describedby="addon-prenom" id="inputName" placeholder="Entrer son prénom">
					</div>
				</div>
			</form>
        </div>
        <div class="modal-footer">
			<button type="submit" class="btn btn-warning btn-lg submitBtn" onclick="submitForm()"><span class="glyphicon glyphicon-ok-sign"></span>Enregistrer</button>
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
        </div>
      </div>
     </div>
	</div>
	
	<!-- Modal #SaveReturnDialog-->
	<form class="form-vertical" method="post" action="index.php?controller=materielPret&action=saveReturn">
	  <div class="modal fade" id="saveReturnDialog" tabindex="-1" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content -->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <p class="h3 modal-title">Enregistrer le retour</p>
			</div>
			<div class="modal-body">
				<div class="form-group hide">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-preter-id">Identifiant du matériel :</span>
						<input type='text' class='form-control' name='preter_id' aria-describedby='addon-preter-id' value="<?php echo $lastPreterId ?>" readonly>
					</div>
				</div>
				
				<div class="form-group hide">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-materiel_pret_id">Identifiant du matériel :</span>
						<input type='text' class='form-control' name='materiel_pret_id' aria-describedby='addon-materiel_pret_id' value="<?php echo $tab_materiel_pret[0]->materiel_pret_id ?>" readonly>
					</div>
				</div>
			
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-nni">NNI :</span>
						<input type='text' class='form-control' name='NNI' aria-describedby='addon-nni' value="<?php echo $lastNNI ?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-nom">Nom du membre :</span>
						<input type='text' class='form-control' name='membre_nom' aria-describedby='addon-nom' id="membre_nom" value="<?php echo $lastSurname ?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-prenom">Prenom du membre :</span>
						<input type='text' class='form-control' name='membre_prenom' aria-describedby='addon-prenom' id="membre_prenom" value="<?php echo $lastName ?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-date-loan">Date d'emprunt:</span>
						<input class="form-control " type="text" name='date_emprunt' aria-describedby='addon-date-loan' id="date_emprunt" value="<?php echo $lastDateLoan ?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-date-return">Date de retour:</span>
						<input class="form-control " type="text" name='date' aria-describedby='addon-date-return' id="date_retour" value="" placeholder="YYYY/MM/DD" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="addon-commantaire">Commentaire:</span>
						<textarea name="commentaire" class="form-control" rows="3" aria-describedby='addon-commentaire'></textarea>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
			<button type="submit" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-ok-sign"></span>Enregistrer</button>
			  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Annuler</button>
			</div>
			
		  </div>
		  
		</div>
	  </div>
	 </form>
	
    </section>
  </div>  
  
</div>