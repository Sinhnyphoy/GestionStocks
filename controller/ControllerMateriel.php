<?php

require_once File::build_path(array('model', 'ModelMateriel.php'));

class ControllerMateriel {	
	protected static $object = "materiel";

	//appeler le Model et envoyer les données sur la page "listMateriel"
	public static function readAll() {
        $tab_materiel = ModelMateriel::selectAll();
		$tab_materiel_alert = ModelMateriel::selectValCommande();
        $view='listMateriel';
        $pagetitle = "liste des materiels";
        require_once File::build_path(array('view','view.php'));
    }
	
	//récupérer Id, le tester et l'envoyer sur le page du formulaire
	public static function formModify() {
        $materiel_id = $_POST['materiel_id'];
        
        if(isset($materiel_id) && !empty($materiel_id)) {
			$tab_materiel = ModelMateriel::selectById($materiel_id);
        } 
		else {
            $message = GET_VALUE_ERR;
        }
        require_once 'view/materiel/formulaireModifMateriel.php';
    }
	
	//récupérer les données, les tester et les enregistrers par appeler au Model
	//et envoyer sur le page correspondant
	public static function modify() {
		$materiel_id = $_POST['materiel_id'];
		$materiel_nom = $_POST['materiel_nom'];
		$quantite_restante = $_POST['quantite_restante'];
		$seuil_bas = $_POST['seuil_bas'];
		$commandé = $_POST['commandé'];
        
        if(isset($materiel_id) && isset($materiel_nom) &&isset($quantite_restante) && isset($seuil_bas) && 
			!empty($materiel_id) && !empty($materiel_nom) &&!empty($quantite_restante) && !empty($seuil_bas)) {
			
			$modifMateriel = new ModelMateriel($materiel_id, $materiel_nom, $quantite_restante, $seuil_bas, $commandé);
			$modifMateriel->update($quantite_restante, $seuil_bas, $commandé, $materiel_id);

			$message = SAVED;
			$pagetitle = "liste des materiels modifié";
			
		} else {
			$message = MODIF_ERR;
            $pagetitle="Erreur de modifier";
        }
		$tab_materiel = ModelMateriel::selectAll();
		$tab_materiel_alert = ModelMateriel::selectValCommande();
		$view='listMateriel';
        require_once File::build_path(array('view','view.php'));
    }
	
}

