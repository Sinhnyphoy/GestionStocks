<?php

require_once File::build_path(array("model", "Model.php"));

class ModelMateriel extends Model {
	private $materiel_id;
    private $materiel_nom;
    private $quantite_restante;
	private $seuil_bas;
	private $commandé;
    protected static $object = "materiel";
	protected static $primary = "materiel_id";

    /**
     * constructeur de la classe ModelMateriel
     * $materiel_id INT l'identifiant du matériel (AUTO_INCREMENT)
     * $materiel_nom STRING le nom du matériel
     * $quantite_restante INT le nombre du matériel dans le stock
     * $seuil_bas INT le nombre minimum du matériel dans le stock
     * $commandé BOOLEAN si on a commandé le matériel (OUI||NON)
     */
    public function __construct($materiel_id, $materiel_nom, $quantite_restante, $seuil_bas, $commandé) {
        $this->materiel_id = $materiel_id;
		$this->materiel_nom = $materiel_nom;
        $this->quantite_restante = $quantite_restante;
		$this->seuil_bas = $seuil_bas;
		$this->commandé = $commandé;
    }
	
    //méthode d'enregistrer un matériel par son materiel_id
	public static function update($quantite_restante, $seuil_bas, $commandé, $materiel_id) { 
		try {
        $sql = "UPDATE materiel SET quantite_restante=?, seuil_bas=?, commandé=? WHERE materiel_id=? ";
        $bdd = new Model();
        $req_prep = $bdd::$pdo->prepare($sql);
        $values = array($quantite_restante, $seuil_bas, $commandé, $materiel_id);
        $req_prep->execute($values);
		 } catch (Exception $ex) {
                echo $ex->getMessage(); 
                die();
        }
    }
	
	//méthode de mise à jour le nombre du matériel dans le stock
	public static function updateQte($quantite_restante, $materiel_id) { 
		try {
        $sql = "UPDATE materiel SET quantite_restante=? WHERE materiel_id=? ";
        $bdd = new Model();
        $req_prep = $bdd::$pdo->prepare($sql);
        $values = array($quantite_restante, $materiel_id);
        $req_prep->execute($values);
		 } catch (Exception $ex) {
                echo $ex->getMessage(); 
                die();
        }
    }
	
	//fonction de sélectionner toutes les colonnes de la table materiel par materiel_id
	public static function selectById($materiel_id) {
		try {
            $sql = "SELECT * FROM materiel WHERE materiel_id='".$materiel_id."';";
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
	
	//fonction de sélectionner toutes les colonnes où la quantité dans le stock est inférieur ou égal aux quantités minimum
	//Cette fonction utilise dans une alerte permanente
	public static function selectValCommande() {
		try {
            $sql = "SELECT * FROM materiel WHERE quantite_restante<=seuil_bas AND commandé=1;";
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
