<span class="message"><?php if (isset($message)) echo $message; ?></span>

<?php	
	if (!empty($tab_appartenir)) {
		
		echo "<p class='h3'>";
			echo "<span class='label label-info'>Nom du matériel : " . $tab_appartenir[0]->materiel_nom . "</span>";
			echo "<input type='hidden' class='form-control' name='designation' value='".$tab_appartenir[0]->materiel_nom."'>";
		echo "</p>";
 
?>

		<table class="table table-hover table-responsive table-striped table-bordered">
			<thead>
				<tr>
					<th scope="col">Quantité matériel</th>
					<th scope="col">Date</th>
					<th scope="col" colspan="2">Commentaire</th>
				</tr>
			</thead>
			<tbody>
				  
 <?php   
		foreach($tab_appartenir as $appartenir){
			echo "<tr>";
			echo "<th style='display: none;'>" . $appartenir->materiel_nom . "</th>";
			echo "<td style='display: none;'>" . $appartenir->materiel_id . "<input type='hidden' class='form-control' name='materiel_id' value='" . $appartenir->materiel_id . "'></td>";				
			echo "<td>" . $appartenir->quantite_materiel . "<input type='hidden' class='form-control' name='quantite_materiel' value='" . $appartenir->quantite_materiel . "'></td>";				
			echo "<td>" . $appartenir->date . "<input type='hidden' class='form-control' name='date' value='" . $appartenir->date . "'></td>";
			echo "<td>" . $appartenir->commentaire . "</td>";
			echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editCommentDialog' data-id='" . $appartenir->appartenir_id . "' data-nni='" .$tab_appartenir[0]->NNI. "' 
						data-materiel_id='" . $appartenir->materiel_id . "' data-qte-stock='" . $appartenir->quantite_materiel . "' data-date='" . $appartenir->date . "' data-cmm='" . $appartenir->commentaire . "'
						title='Modifier le commentaire' id='getComment'><span class='glyphicon glyphicon-edit'></span></button></td>";
			echo "</tr>";
		}				
	} else {
		echo "<div class='alert alert-info' role='alert'>Aucune histoire !!</div>";
	}
?>
			</tbody>
		</table> 
				
				
	
	