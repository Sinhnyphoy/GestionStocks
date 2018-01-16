<?php
	include("head.php");
?>
	<div class="container">

      <form class="form-signin" method="post" action="index.php?controller=login&action=connect">
        <h1 class="form-signin-heading">Gestion du stock</h1>
        <h3 class="form-signin-heading">Connexion</h3>
        
        <label for="inputUsername" class="sr-only">Nom d'utilisateur</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Nom d'utilisateur" value="<?php if (isset($username)) echo $username; ?>" autofocus>
        <span class="error"><?php if (isset($usernameErr)) echo $usernameErr; ?></span>
		
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Mot de passe">
		<span class="error"><?php if (isset($passwordErr)) echo $passwordErr; ?></span>
		
        <div class="checkbox">
            <label><input type="checkbox" name="remember" value="on"> Se souvenir de moi</label> 
        </div>
		 
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
      </form>

    </div> <!-- /container -->


<?php	
	include("footer.php"); 
?>