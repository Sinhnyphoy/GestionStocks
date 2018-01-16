<?php
date_default_timezone_set("Europe/Paris");
require_once File::build_path(array('model', 'ModelMaterielPret.php'));
require_once File::build_path(array('model', 'ModelPreter.php'));

class ControllerMaterielPret {	
	protected static $object = "materiel_pret";

	//appeler le Model et envoyer les données sur la page "listMaterielPret"
	public static function readAll() {
        $tab_materiel_pret = ModelMaterielPret::select();
		$tab_materiel_alert = ModelMateriel::selectValCommande();
		
        $view='listMaterielPret';
        $pagetitle = "Liste des materiels de prêt";
        require_once File::build_path(array('view','view.php'));
    }
	
	//récupérer l'id et appeler au Model en mettre ID en paramètre
	public static function searchById() {
        $materiel_pret_id = $_POST['materiel_pret_id'];
		
        if(isset($materiel_pret_id) && !empty($materiel_pret_id)) {
			$tab_materiel_pret = ModelMaterielPret::selectIdNom($materiel_pret_id);
			$result_designation = ModelMaterielPret::selectDesignation($materiel_pret_id);		

			$view='historiqueMaterielPret';
			$pagetitle="Histoire du matériel de prêt";
        } else {
			
			$message = GET_VALUE_ERR;
			$tab_materiel_pret = ModelMaterielPret::select();
			$view='listMaterielPret';
			$pagetitle = "Liste des materiels de prêt";
        }
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }
	
	
	public static function saveLoan() {
		$preter_id = null;
		$info = $_POST['info'];
		$membre = explode(" | ", $info);
        $NNI = $membre[0];
		$materiel_pret_id = $_POST['materiel_pret_id'];
		$dateEmprunt = new DateTime($_POST['date']);
		$date_emprunt = $dateEmprunt->format("Y/m/d");
		$date_retour = null;
		$dateNow = new DateTime("now");
		$today = $dateNow->format("Y/m/d");
		
		if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
			$commentaire = $_POST['commentaire'];
		} else {
			$commentaire = '';
		}
		
		if(isset($_POST['last_date']) && !empty($_POST['last_date'])){
			$last_date = new DateTime($_POST['last_date']);
			$lastDate = $last_date->format("Y/m/d");
		} else {
			$lastDate = '';
		}
        
        if(isset($NNI) && isset($materiel_pret_id) && isset($date_emprunt) &&
			!empty($NNI) && !empty($materiel_pret_id) && !empty($date_emprunt)) {
				
			if($date_emprunt < $lastDate) {
				$message = DATE_INVALIDE;
			} 
			else if($date_emprunt > $today){
				$message = DATE_NEWER_THAN_TODAY;
			}
			else {
				$newEmprunt = new ModelPreter($preter_id, $NNI, $materiel_pret_id, $date_emprunt, $date_retour, $commentaire);
				$newEmprunt->save();
				$message = SAVED;
			}
			$tab_materiel_pret = ModelMaterielPret::selectIdNom($materiel_pret_id);
			$result_designation = ModelMaterielPret::selectDesignation($materiel_pret_id);

            $view='historiqueMaterielPret';
            $pagetitle="Enregistrer Prêt";
        } else {
			
			$message = GET_VALUE_FORM_ERR;
            $tab_materiel_pret = ModelMaterielPret::select();
			$view='listMaterielPret';
			$pagetitle = "Liste des materiels de prêt";
        }
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }
	
	public static function saveReturn() {
        $NNI = $_POST['NNI'];
		$materiel_pret_id = $_POST['materiel_pret_id'];
		$dateEmprunt = new DateTime($_POST['date_emprunt']);
		$date_emprunt = $dateEmprunt->format("Y/m/d");
		$dateRetour = new DateTime($_POST['date']);
		$date_retour = $dateRetour->format("Y/m/d");
		$dateNow = new DateTime("now");
		$today = $dateNow->format("Y/m/d");
		
		if(isset($_POST['preter_id']) && !empty($_POST['preter_id'])){
			$preter_id = $_POST['preter_id'];
		} else {
			$preter_id = '';
		}
		
		if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
			$commentaire = $_POST['commentaire'];
		} else {
			$commentaire = '';
		}
        
        if(isset($NNI) && isset($materiel_pret_id) && isset($date_emprunt) && isset($date_retour) &&
			!empty($NNI) && !empty($materiel_pret_id) && !empty($date_emprunt) && !empty($date_retour)) {
				
			if($date_retour < $date_emprunt){
				$message = DATE_OLDER_THAN_DATELOAN;
			}
			else if($date_retour > $today){
				$message = DATE_NEWER_THAN_TODAY;
			}
			else {
				$newReturn = new ModelPreter($preter_id, $NNI, $materiel_pret_id, $date_emprunt, $date_retour, $commentaire);
				$newReturn->updateReturn($date_retour, $commentaire, $preter_id);
				$message = SAVED;
			}
			$tab_materiel_pret = ModelMaterielPret::selectIdNom($materiel_pret_id);
			
            $view='historiqueMaterielPret';
            $pagetitle="Enregistrer Retour";
        } else {
            
			$message = GET_VALUE_FORM_ERR;
            $tab_materiel_pret = ModelMaterielPret::select();
			$view='listMaterielPret';
			$pagetitle = "Liste des materiels de prêt";
        }
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }

	
	public static function saveNewMember() {
        $NNI = $_POST['nni'];
		$membre_nom = $_POST['surname'];
		$membre_prenom = $_POST['name'];
        
        if(isset($_POST['formSubmit']) &&
			isset($NNI) &&
			isset($membre_nom) &&
			isset($membre_prenom) &&
			!empty($NNI) &&
			!empty($membre_nom) &&
			!empty($membre_prenom)) {
				
			$newMembre = new ModelMembre($NNI, $membre_nom, $membre_prenom);
			$newMembre->save();
				
			$tab_materiel_alert = ModelMateriel::selectValCommande();
			$status = 'ok';
        } 
		else{
			$status = 'err';
		}
		// Output status
		echo $status;
		die();
    }
}

