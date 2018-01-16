<?php

require_once File::build_path(array("model", "Model.php"));

class ModelMaterielPret extends Model {
	private $materiel_pret_id;
    private $commentaire;
    private $disponible;
	private $type_id;
    protected static $object = "materiel_pret";
	protected static $primary = "materiel_pret_id";

    /**
     * constructeur de la classe ModelMaterielPret
     * $materiel_pret_id STRING l'identifiant du matériel de prêt
     * $commentaire STRING le commentaire du matériel de prêt
     * $disponible BOOLEAN la disponibilité du matériel de prêt
     * $type_id INT l'identifiant du type de matériel de prêt
     */
    public function __construct($materiel_pret_id, $commentaire, $disponible, $type_id) {
        $this->materiel_pret_id = $materiel_pret_id;
		$this->commentaire = $commentaire;
        $this->disponible = $disponible;
		$this->type_id = $type_id;
    }
	
    //fonction de sélectionner toutes les colonnes de deux tables
	public static function select() {
		try {
            $sql = "SELECT * FROM materiel_pret, type_materiel_pret
					WHERE materiel_pret.type_id=type_materiel_pret.type_id;";
            $bdd = new Model();
            $rep = Model::$pdo->query($sql);
            $tab = $rep->fetchAll(PDO::FETCH_OBJ);
            return $tab;
        } catch (PDOException $ex) {
            if(Configuration::getDebug()) {
                echo $ex->getMessage(); // affiche un message d'erreur
                die();
            }
        }
	}

	//fonction de sélectionner toutes les colonnes par materiel_pret_id  et trier par preter_id en ascendant
	public static function selectIdNom($materiel_pret_id) {
		try {
            $sql = "SELECT *
					FROM materiel_pret, type_materiel_pret, preter, membre
					WHERE materiel_pret.type_id=type_materiel_pret.type_id
					AND materiel_pret.materiel_pret_id=preter.materiel_pret_id
					AND preter.NNI=membre.NNI
					AND preter.materiel_pret_id='".$materiel_pret_id."'
					ORDER BY preter_id ASC;";
            $bdd = new Model();
            $rep = Model::$pdo->query($sql);
            $tab = $rep->fetchAll(PDO::FETCH_OBJ);
            return $tab;
        } catch (PDOException $ex) {
            if(Configuration::getDebug()) {
                echo $ex->getMessage(); // affiche un message d'erreur
                die();
            }
        }
	}
	
	//fonction de sélectionner la désignation par materiel_pret_id
	public static function selectDesignation($materiel_pret_id) {
		try {
            $sql = "SELECT designation
					FROM materiel_pret, type_materiel_pret
					WHERE materiel_pret.type_id=type_materiel_pret.type_id
					AND materiel_pret_id='".$materiel_pret_id."';";
            $bdd = new Model();
            $rep = Model::$pdo->query($sql);
            $result = $rep->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $ex) {
            if(Configuration::getDebug()) {
                echo $ex->getMessage(); // affiche un message d'erreur
                die();
            }
        }
	}
}
