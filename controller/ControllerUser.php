<?php

require_once File::build_path(array('model', 'ModelUser.php'));

class ControllerUser {	
	protected static $object = "utilisateur";

	
	public static function editPwd() {
		$username = $_COOKIE['username'];
        $tab_utilisateur = ModelUser::getUser($username);
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        $view='myProfile';
        $pagetitle = "Mon Profil";
        require_once File::build_path(array('view','view.php'));
    }
	
	public static function savePwd() {
		$user_id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$pwd_confirm = $_POST['password_confirm'];
		
		if(isset($user_id) && isset($username) && isset($password) &&
			!empty($user_id) && !empty($username) && !empty($password)) {
			
			if($pwd_confirm == $password) {
				$newPwd = new ModelUser($user_id, $username, $password);
				$newPwd->updatePwd($password, $user_id);
				
				$message = SAVED;
				$pagetitle = "Mon Profil";
				
			} else {
				$message = MODIF_ERR;
				$pagetitle="Erreur de modifier";
			}
						
			$tab_utilisateur = ModelUser::getUser($username);
			$tab_materiel_alert = ModelMateriel::selectValCommande();
			$view='myProfile';
		}
        require_once File::build_path(array('view','view.php'));
    }

}

