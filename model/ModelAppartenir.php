<?php

require_once File::build_path(array("model", "Model.php"));

class ModelAppartenir extends Model {
	private $appartenir_id;
	private $NNI;
    private $materiel_id;
    private $quantite_materiel;
    private $date;
	private $commentaire;

    /**
     * constructeur de la classe ModelAppartenir
     * $appartenir_id INT numero d'identifiant de la table Appartenir (AUTO_INCREMENT)
     * $NNI STRING l'identifiant du membre
     * $materiel_id INT l'identifiant du matériel (AUTO_INCREMENT)
     * $quantite_materiel INT nombre du matériel affecté par membre
     * $date DATE la date d'attribuer de ce matériel
     * $commentaire STRING le commentaire de l'attribution d'un matériel
     */
    public function __construct($appartenir_id, $NNI, $materiel_id, $quantite_materiel, $date, $commentaire) {
        $this->appartenir_id = $appartenir_id;
        $this->NNI = $NNI;
		$this->materiel_id = $materiel_id;
        $this->quantite_materiel = $quantite_materiel;
        $this->date = $date;
        $this->commentaire = $commentaire;
    }
	
    //méthode d'enregistrer l'attribution d'un matériel
    public function save() {
        try {
            $sql = "INSERT INTO appartenir(appartenir_id,NNI,materiel_id,quantite_materiel,date,commentaire) VALUES (:tag_appartenir_id, :tag_NNI, :tag_materiel_id, :tag_quantite_materiel, :tag_date, :tag_commentaire);";
            $bdd = new Model();
            $req_prep = $bdd::$pdo->prepare($sql);
            $values = array(
                "tag_appartenir_id" => $this->appartenir_id,
                "tag_NNI" => $this->NNI,
                "tag_materiel_id" => $this->materiel_id,
                "tag_quantite_materiel" => $this->quantite_materiel,
				"tag_date" => $this->date,
				"tag_commentaire" => $this->commentaire
            );
            $req_prep->execute($values);
        } catch (Exception $ex) {
                echo $ex->getMessage(); 
                die();
        }
    }
	
	//méthode d'enregistrer le commentaire par appartenir_id
	public static function updateCmm($commentaire, $appartenir_id) { 
		try {
        $sql = "UPDATE appartenir SET commentaire=? WHERE appartenir_id=? ";
        $bdd = new Model();
        $req_prep = $bdd::$pdo->prepare($sql);
        $values = array($commentaire, $appartenir_id);
        $req_prep->execute($values);
		 } catch (Exception $ex) {
            echo $ex->getMessage(); 
            die();
        }
    }

	//fonction de sélectionner les colonnes par NNI et materiel_id et trier par materiel_id en ascendant	
	public static function selectById($NNI, $materiel_id) {
		try {
            $sql = "SELECT appartenir_id, appartenir.materiel_id, appartenir.NNI, materiel.materiel_nom, quantite_materiel, date, commentaire
					FROM materiel, membre, appartenir 
					WHERE materiel.materiel_id=appartenir.materiel_id
					AND membre.NNI=appartenir.NNI
					AND appartenir.NNI='".$NNI."'
					AND appartenir.materiel_id='".$materiel_id."'
					AND appartenir_id NOT IN (SELECT appartenir_id FROM appartenir WHERE NNI='".$NNI."' AND materiel_id='".$materiel_id."' AND quantite_materiel=0)
					ORDER BY appartenir.materiel_id ASC;";
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
	
	//fonction de sélectionner les colonnes par appartenir_id	
	public static function selectByMainId($appartenir_id) {
		try {
            $sql = "SELECT appartenir_id, appartenir.materiel_id, appartenir.NNI, materiel.materiel_nom, quantite_materiel, date, commentaire
					FROM materiel, appartenir 
					WHERE materiel.materiel_id=appartenir.materiel_id
					AND appartenir.appartenir_id='".$appartenir_id."';";
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
