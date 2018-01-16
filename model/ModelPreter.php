<?php

require_once File::build_path(array("model", "Model.php"));

class ModelPreter extends Model {
	private $preter_id;
	private $NNI;
	private $materiel_pret_id;
	private $date_emprunt;
	private $date_retour;
    private $commentaire;

    /**
     * constructeur de la classe ModelPreter
     * $preter_id INT numero d'identifiant de la table Preter (AUTO_INCREMENT)
     * $NNI STRING l'identifiant du membre
     * $materiel_pret_id STRING l'identifiant du matériel de prêt
     * $date_emprunt DATE la date de prêt un matériel
     * $date_retour DATE la date de retour du matériel
     * $commentaire STRING le commentaire du prêt
     */
    public function __construct($preter_id, $NNI, $materiel_pret_id, $date_emprunt, $date_retour, $commentaire) {
        $this->preter_id = $preter_id;
        $this->NNI = $NNI;
        $this->materiel_pret_id = $materiel_pret_id;
        $this->date_emprunt = $date_emprunt;
        $this->date_retour = $date_retour;
		$this->commentaire = $commentaire;
    }
	
	
    //méthode d'enregistrer le prêt d'un matériel
	public function save() {
        try {
            $sql = "INSERT INTO preter(preter_id,NNI,materiel_pret_id,date_emprunt,date_retour,commentaire) 
					VALUES (:tag_preter_id, :tag_NNI, :tag_materiel_pret_id, :tag_date_emprunt, :tag_date_retour, :tag_commentaire);";
            $bdd = new Model();
            $req_prep = $bdd::$pdo->prepare($sql);
            $values = array(
                "tag_preter_id" => $this->preter_id,
                "tag_NNI" => $this->NNI,
                "tag_materiel_pret_id" => $this->materiel_pret_id,
                "tag_date_emprunt" => $this->date_emprunt,
                "tag_date_retour" => $this->date_retour,
                "tag_commentaire" => $this->commentaire
            );
            $req_prep->execute($values);
            $this->set('preter_id', $bdd::$pdo->lastInsertId()); //AUTO INCREMENT
        } catch (Exception $ex) {
                echo $ex->getMessage(); 
                die();
        }
    }
	
	/**
	 * méthode d'enregistrer le retour d'un matériel
	 * $date_retour DATE la date de retour du matériel
	 * $commentaire STRING le commentaire du prêt
	 * $preter_id INT numero d'identifiant de la table Preter (AUTO_INCREMENT)
	 */
	public static function updateReturn($date_retour, $commentaire, $preter_id) { 
		try {
        $sql = "UPDATE preter SET date_retour=?, commentaire=? WHERE preter_id=?";
        $bdd = new Model();
        $req_prep = $bdd::$pdo->prepare($sql);
        $values = array($date_retour, $commentaire, $preter_id);
        $req_prep->execute($values);
		 } catch (Exception $ex) {
                echo $ex->getMessage(); 
                die();
        }
    }
}
