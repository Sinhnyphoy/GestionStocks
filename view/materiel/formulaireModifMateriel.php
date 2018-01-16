<!-- Formulaire de modifier "quantité dans stock", "seuil bas" et "commandé" d'un matériel. Ce formulaire sera être afficher dans une fenêtre modale.-->

<span class="message"><?php if (isset($message)) echo $message; ?></span>

<?php	
	if (!empty($tab_materiel)) { 
		foreach($tab_materiel as $materiel) {
	
?>
	<fieldset>
		<div class="form-group">
		
			<div class="input-group input-group-lg hide">
			<span class="input-group-addon" id="addon-id">Id du matériel :</span>
			  <input type="text" class="form-control" name="materiel_id" aria-describedby="addon-id" value="<?php echo $materiel->materiel_id; ?>" readonly>
			</div>
			
			<div class="input-group input-group-lg">
			  <span class="input-group-addon" id="addon-name">Nom du matériel :</span>
			  <input type="text" class="form-control" name="materiel_nom" aria-describedby="addon-name" value="<?php echo $materiel->materiel_nom; ?>" readonly>
			</div>
			
			<div class="input-group input-group-lg">
			  <span class="input-group-addon" id="addon-qte">Quantité dans stock :</span>
			  <input type="text" class="form-control" name="quantite_restante" aria-describedby="addon-qte" value="<?php echo $materiel->quantite_restante; ?>" placeholder="Nombre de matériel dans stock" required>
			</div>
			
			<div class="input-group input-group-lg">
			  <span class="input-group-addon" id="addon-seuil">Seuil bas :</span>
			  <input type="text" class="form-control" name="seuil_bas" aria-describedby="addon-seuil" value="<?php echo $materiel->seuil_bas; ?>" placeholder="Nombre minimum du matériel dans stock" required>
			</div>
			
			<div class="input-group input-group-lg">
			  <span class="input-group-addon" id="addon-commande">Commandé :</span>
				<div class="btn-group  btn-group-lg" data-toggle="buttons">
				<?php if($materiel->commandé == 1){?>
					<label class="btn btn-primary">
						<input type="radio" name="commandé" class="form-control" aria-describedby="addon-commande" value="0"/>Oui
					</label>
					<label class="btn btn-primary active">
						<input type="radio" name="commandé" class="form-control" aria-describedby="addon-commande" value="1" checked />Non
					</label>
				<?php } else {?>
					<label class="btn btn-primary active">
						<input type="radio" name="commandé" class="form-control" aria-describedby="addon-commande" value="0" checked />Oui
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="commandé" class="form-control" aria-describedby="addon-commande" value="1"/>Non
					</label>
					<?php }?>
				</div>
			</div>
		</div>   
    </fieldset>
<?php 
		}
	} else {
		echo "<div class='alert alert-warning' role='alert'>Ne pas pouvoir modifier</div>";
	}
?>
