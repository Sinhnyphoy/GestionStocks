<?php

require_once File::build_path(array('model', 'ModelUser.php'));

class ControllerLogin {
	
	protected static $object = "materiel";
	
	//fonction de examiner la connexion
	public static function connect() {		
		$username = $_POST['username'];
		$password = $_POST['pwd'];

		if(empty($username) || empty($password)) {
			if(empty($username)){
				$usernameErr = "<div class='alert alert-warning'>Saisir le nom d'utilisateur</div>";
			}
			if(empty($password)){
				$passwordErr = "<div class='alert alert-warning'>Saisir le mot de passe</div>";
			} 
			else {
				$passwordErr = "<div class='alert alert-warning'>Saisir le mot de passe!</div>";
			}
			$view = 'login';
			$pagetitle = 'Connexion';
			require_once File::build_path(array("view", "$view.php"));
		}
		else
		{
			if(isset($_POST['remember'])){
				$remember = "on";
			}else{
				$remember = "";
			}
				
			$users = ModelUser::getUser($username);
			if(!empty($users)) {
				foreach($users as $user)
				{
					$db_username = $user->utilisateur_nom;
					$db_pwd = $user->mot_de_passe;
				}
				
				if($db_pwd == $password){
					$username = $db_username;
					$tab_materiel = ModelMateriel::selectAll();
					$tab_materiel_alert = ModelMateriel::selectValCommande();
						
					if($remember == "on"){ //remember me checked
						setcookie('username',$username,time() + (86400  * 10));
					}else{ //remember me not checked
						session_start();
						$_SESSION['username'] = $username;
					}
						
					$view = 'listMateriel';
					$pagetitle = 'Liste matériels';
					require_once File::build_path(array("view", "view.php"));
				} else {
					$passwordErr = "<div class='alert alert-danger'>Le mot de passe est incorrect</div>";
					$view = 'login';
					$pagetitle = 'Connexion';
					require_once File::build_path(array("view", "$view.php"));
				}
			} else {
				$usernameErr = "<div class='alert alert-danger'>Le nom d'utilisateur est incorrect</div>";
				$view = 'login';
				$pagetitle = 'Connexion';
				require_once File::build_path(array("view", "$view.php"));
			}
			
		}
	}

}