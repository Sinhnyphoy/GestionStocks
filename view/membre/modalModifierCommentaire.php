<span class="message"><?php if (isset($message)) echo $message; ?></span>

<?php	
	if (!empty($tab_appartenir)) {
		foreach($tab_appartenir as $appartenir){
?>
			<div class="form-group hide">
				<div class="input-group input-group-lg">
					<span class="input-group-addon" id="addon-main-id">Id app :</span>
					<input type='text' class='form-control' name='appartenir_id' aria-describedby='addon-main-id' value="<?php echo $appartenir->appartenir_id ?>">
				</div>
			</div>

			<table class="table table-hover table-striped table-bordered">
				<tr>
					<th scope="col">NNI</th>
					<td><input type='hidden' class='form-control' name='NNI' value="<?php echo $appartenir->NNI ?>"/><?php echo $appartenir->NNI ?></td>
				</tr>
				<tr class="hide">
					<th scope="col">Id du matériel</th>
					<td><input type='hidden' class='form-control' name='materiel_id' value="<?php echo $appartenir->materiel_id ?>" /><?php echo $appartenir->materiel_id ?></td>
				</tr>
				<tr>
					<th scope="col">Nom du matériel</th>
					<td><input type='hidden' class='form-control' name='materiel_nom' value="<?php echo $appartenir->materiel_nom ?>" /><?php echo $appartenir->materiel_nom ?></td>
				</tr>
				<tr>
					<th scope="col">Quantité du matériel</th>
					<td><input type='hidden' class='form-control' name='quantite_materiel' value="<?php echo $appartenir->quantite_materiel ?>" /><?php echo $appartenir->quantite_materiel ?></td>
				</tr>
				<tr>
					<th scope="col">Date</th>
					<td><input type='hidden' class='form-control' name='date' value="<?php echo $appartenir->date ?>" /><?php echo $appartenir->date ?></td>
				</tr>
			</table>
							
			<span class="input-group-addon" id="addon-comment">Commentaire à modifier</span>
			<textarea class="form-control" type="text" name='commentaire' aria-describedby='addon-comment' rows="3" value="<?php echo $appartenir->commentaire ?>" placeholder="Saisir le nouveau commentaire..." required><?php echo $appartenir->commentaire ?></textarea>

<?php
		}
	} else {
		echo "<div class='alert alert-warning' role='alert'>Ne pas pouvoir modifier</div>";
	}
?>