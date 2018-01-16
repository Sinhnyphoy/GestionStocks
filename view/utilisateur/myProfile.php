    <section class="content-inner">
	<div class="page-header">
		<h2>Profil</h2>
	</div>
	
	<span class="message"><?php if (isset($message)) echo $message; ?></span>
	
	<?php
		if (!empty($tab_utilisateur)) {
			foreach($tab_utilisateur as $utilisateur){?>
			
	<div class="container">
	<form class="form-vertical" method="post" action="index.php?controller=user&action=savePwd">
		<div class="col-md-6">
		<br style="clear:both">
		<h3>Mes identifiants</h3>
		<br>
		
		<div class="form-group hide">
			<label id="addon-username">ID utilisateur :</label>
			<input type='text' class='form-control' name='id' aria-describedby='addon-username' value="<?php echo $utilisateur->utilisateur_id; ?>" readonly>
		</div>
				
		<div class="form-group">
			<label id="addon-username">Nom d'utilisateur :</label>
			<div class="input-group input-group-lg">
				<input type='text' class='form-control' name='username' aria-describedby='addon-username' value="<?php echo $utilisateur->utilisateur_nom; ?>" readonly>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-user"></span>
				</span>
			</div>
		</div>
				
		<div class="form-group">
			<label id="addon-password">Mot de passe :</label>
			<div class="input-group input-group-lg">
				<input type='password' class='form-control' id="pwd" aria-describedby='addon-password' value="<?php echo $utilisateur->mot_de_passe; ?>" readonly>
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="eye"><span class="glyphicon glyphicon-eye-open"></span></button>
				</span>
			</div>
		</div>
					
			  		</div>
	
	<div class="col-md-6 form-line">
    <div class="form-area">  
        
        <br style="clear:both">
	<h3> Changer le mot de passe </h3>
		<br>
		<div class="form-group">
			<label id="addon-new-password">Noveau mot de passe :</label>
			<div class="input-group input-group-lg">
				<input type='password' class='form-control' name='password' id="newPwd" aria-describedby='addon-new-password' placeholder="Nouveau mot de passe" required>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</div>
				</div>
				
				<div class="form-group">
						<label id="addon-password-confirm">Confirmation le nouveau mot de passe :</label>
						<div class="input-group input-group-lg">
						<input type='password' class='form-control' name='password_confirm' id="newPwdConfirm" aria-describedby='addon-password-confirm' placeholder="Nouveau mot de passe (Confirmation)" required>
						<span class="input-group-addon">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</div>
				</div>
			<div class="form-group">	
		<input type="checkbox" onclick="showPassword()"> Visualiser le mot de passe </div>
	<button class = "btn btn-primary btn-lg" type="submit" class="form-control" >Enregistrer</button>	
	
	
	<br style="clear:both">	
    </div>
</div>
</form>
	</div>
	<?php 
		}
	}
	
	?>
	
	
    </section>
  </div>  
  
</div>