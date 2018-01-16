<?php

require_once File::build_path(array('model', 'ModelMembre.php'));
require_once File::build_path(array('model', 'ModelAppartenir.php'));

class ControllerMembre {	
	protected static $object = "membre";

	//appeler le Model et envoyer les données sur la page "listMembre"
	public static function readAll() {
        $tab_membre = ModelMembre::selectAll();
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        $view='listMembre';
        $pagetitle = "Liste des membres";
        require_once File::build_path(array('view','view.php'));
    }
	
	public static function saveMembre() {
        $NNI = $_POST['NNI'];
		$membre_nom = $_POST['membre_nom'];
		$membre_prenom = $_POST['membre_prenom'];
        
        if(isset($NNI) && isset($membre_nom) && isset($membre_prenom) &&
			!empty($NNI) && !empty($membre_nom) && !empty($membre_prenom)) {
				
			$newMembre = new ModelMembre($NNI, $membre_nom, $membre_prenom);
			$newMembre->save();
			$message = SAVED;	
			
        } else {
			$message = GET_VALUE_FORM_ERR;
        }
		$tab_membre = ModelMembre::selectAll();
		$view='listMembre';
		$pagetitle = "Liste des membres";
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }
	
	public static function search() {
        $NNI = $_POST['NNI'];
        
        if(isset($NNI) && !empty($NNI)) {
			$tab_membre = ModelMembre::selectNNI($NNI);
			$tab_appartenir = ModelMembre::selectClause($NNI);
			
			$view='listMaterielParMembre';
            $pagetitle="Matériels d'un membre";
        } else {
			
			$message = GET_VALUE_ERR;
            $tab_membre = ModelMembre::selectAll();
			$view='listMembre';
			$pagetitle = "Liste des membres";
        }
		
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }
	
	public static function story() {
        $NNI = $_POST['NNI'];
        $materiel_id = $_POST['materiel_id'];
        
        if(isset($NNI) && isset($materiel_id) && !empty($NNI) && !empty($materiel_id)) {
			$tab_membre = ModelMembre::selectNNI($NNI);
			$tab_appartenir = ModelAppartenir::selectById($NNI, $materiel_id);
        } 
		else {
            $message = GET_VALUE_ERR;
        }
        require_once 'view/membre/modalHistoire.php';
    }
	
	public static function editComment() {
        $appartenir_id = $_POST['appartenir_id'];
        
        if(isset($appartenir_id) && !empty($appartenir_id)) {
			$tab_appartenir = ModelAppartenir::selectByMainId($appartenir_id);
        } 
		else {
            $message = GET_VALUE_ERR;
        }
        require_once 'view/membre/modalModifierCommentaire.php';
    }
	
	public static function saveComment() {
		$appartenir_id = $_POST['appartenir_id'];
		$NNI = $_POST['NNI'];
		$materiel_id = $_POST['materiel_id'];
		$quantite_materiel = $_POST['quantite_materiel'];
		$date = $_POST['date'];
        $commentaire = $_POST['commentaire'];
		
        if(isset($appartenir_id) && isset($NNI) && isset($materiel_id) &&isset($quantite_materiel) && isset($date) && isset($commentaire) && 
			!empty($appartenir_id) && !empty($NNI) && !empty($materiel_id) &&!empty($quantite_materiel) && !empty($date) && !empty($commentaire)) {
			
			$modifComment = new ModelAppartenir($appartenir_id, $NNI, $materiel_id, $quantite_materiel, $date, $commentaire);
			$modifComment->updateCmm($commentaire, $appartenir_id);
			$message = SAVED;
			
			$tab_membre = ModelMembre::selectNNI($NNI);
			$tab_appartenir = ModelMembre::selectClause($NNI);
			
            $view='listMaterielParMembre';
            $pagetitle="Matériels d'un membre";
		} else {
			
			$message = GET_VALUE_FORM_ERR;
            $tab_membre = ModelMembre::selectAll();
			$view='listMembre';
			$pagetitle = "Liste des membres";
        }
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }
	
	public static function addition() {
		$appartenir_id = null;
		$NNI = $_POST['NNI'];
		$materiel_id = $_POST['materiel_id'];
		$materiel_nom = $_POST['materiel_nom'];
		$quantite_materiel = $_POST['quantite_materiel'];
		$quantite_stock = $_POST['quantite_restante'];
		$date = $_POST['date'];
		
		if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
			$commentaire = $_POST['commentaire'];
		} else {
			$commentaire = '';
		}
        
        if(isset($NNI) && isset($materiel_id) &&isset($quantite_materiel) && isset($date) && 
			!empty($NNI) && !empty($materiel_id) &&!empty($quantite_materiel) && !empty($date)) {
			
			$ajoutMaterielMembre = new ModelAppartenir($appartenir_id, $NNI, $materiel_id, $quantite_materiel, $date, $commentaire);
			$ajoutMaterielMembre->save();
			
			if(!empty($quantite_stock)){
				$quantite_restante = $quantite_stock - $quantite_materiel;
				$newQte = ModelMateriel::updateQte($quantite_restante, $materiel_id);
			}
			$message = SAVED;
			
			$tab_membre = ModelMembre::selectNNI($NNI);
			$tab_appartenir = ModelMembre::selectClause($NNI);

            $view='listMaterielParMembre';
            $pagetitle="Matériels d'un membre";
			
		} else {
            $message = GET_VALUE_FORM_ERR;
            $tab_membre = ModelMembre::selectAll();
			$view='listMembre';
			$pagetitle = "Liste des membres";
        }
		
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        require_once File::build_path(array('view','view.php'));
    }
	
}

