    <section class="content-inner">
	<div class="page-header">
		<h2>Liste des membres</h2>
	</div>
	
	<span class="message"><?php if (isset($message)) echo $message; ?></span>	
	
	<form method="post" action="index.php?controller=membre&action=search">
	  <div class="row">
		<div class="col-xs-6 col-md-4">
		  <div class="input-group">
		   <input type="text" id="myInput"  oninput="w3.filterHTML('#myTable', '.item', this.value)" name="NNI" placeholder="NNI ou Nom" class="form-control">
		   <div class="input-group-btn">
				<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-search"></span>
				</button>
		   </div>
		   </div>
		</div>
		<button class="btn btn-lg btn-primary" type="button" data-toggle="modal" data-target="#myModal">Ajouter membre</button>
	  </div>
	 
	<div class="table-wrapper-2">
	<table class="table table-hover table-responsive" id="myTable">
		<thead>
			<tr>
			  <th scope="col">NNI</th>
			  <th scope="col">Nom</th>
			  <th scope="col">Prénom</th>
			</tr>
		  </thead>
		  <tbody>
<?php
        if (!empty($tab_membre)) {

			foreach ($tab_membre as $membre) {		
				echo "<tr class='item'>";
				echo "<td><input type='submit' class='btn btn-link' name='NNI' value='" . $membre->NNI . "'></td>";
				echo "<td>" . $membre->membre_nom . "</td>";
				echo "<td>" . $membre->membre_prenom . "</td>";
				echo "</tr>";
			}
			
		} else
			echo "<div class='alert alert-info' role='alert'>Aucun membre n'est enregistré dans la base de données</div>";

?>

		</tbody>
	</table>
	</div>
	</form>
	
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
     <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
		<form method="post" action="index.php?controller=membre&action=saveMembre">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="h3 modal-title">
		  <i class="glyphicon glyphicon-user"></i>	Ajouter un membre
		  </p>
        </div>
        <div class="modal-body">
			<div class="form-group">
				<div class="input-group input-group-lg">
				  <span class="input-group-addon" id="addon-nni">NNI :</span>
				  <input type="text" class="form-control" name="NNI" aria-describedby="addon-nni">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group input-group-lg">
				  <span class="input-group-addon" id="addon-nom">Nom :</span>
				  <input type="text" class="form-control" name="membre_nom" aria-describedby="addon-nom">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group input-group-lg">
				  <span class="input-group-addon" id="addon-prenom">Prénom :</span>
				  <input type="text" class="form-control" name="membre_prenom" aria-describedby="addon-prenom">
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
  
</div>
