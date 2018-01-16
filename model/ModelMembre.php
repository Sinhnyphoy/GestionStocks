<?php

require_once File::build_path(array("model", "Model.php"));

class ModelMembre extends Model {
	private $NNI;
    private $membre_nom;
    private $membre_prenom;
    protected static $object = "membre";
	protected static $primary = "NNI";

    /**
     * constructeur de la classe ModelMembre
     * $NNI STRING l'identifiant du membre
     * $membre_nom STRING le nom du membre
     * $membre_prenom STRING le prénom du membre
     */
    public function __construct($NNI, $membre_nom, $membre_prenom) {
        $this->NNI = $NNI;
		$this->membre_nom = $membre_nom;
        $this->membre_prenom = $membre_prenom;
    }
	
    //méthode d'enregistrer un membre
    public function save() {
        try {
            $sql = "INSERT INTO membre(NNI,membre_nom,membre_prenom) VALUES (:tag_NNI, :tag_membre_nom, :tag_membre_prenom);";
            $bdd = new Model();
            $req_prep = $bdd::$pdo->prepare($sql);
            $values = array(
                "tag_NNI" => $this->NNI,
                "tag_membre_nom" => $this->membre_nom,
                "tag_membre_prenom" => $this->membre_prenom,
            );
            $req_prep->execute($values);
        } catch (Exception $ex) {
                echo $ex->getMessage(); 
                die();
        }
    }
	
	//fonction de sélectionner les colonnes correspondantes par NNI et trier par materiel_id en ascendant
	public static function selectClause($NNI) {
		try {
            $sql = "SELECT MAX(appartenir_id) AS max_id, appartenir.materiel_id, materiel.materiel_nom, materiel.quantite_restante, SUM(quantite_materiel) AS sum_qte, MAX(date) AS max_date
					FROM materiel, membre, appartenir 
					WHERE materiel.materiel_id=appartenir.materiel_id
					AND membre.NNI=appartenir.NNI
					AND appartenir.NNI='".$NNI."'
					GROUP BY appartenir.materiel_id ASC;";
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
	
	//fonction de sélectionner toutes les colonnes par NNI
	public static function selectNNI($NNI) {
		try {
            $sql = "SELECT * FROM membre
					WHERE membre.NNI='".$NNI."';";
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

}
