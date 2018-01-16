<?php

require_once File::build_path(array("model", "Model.php"));

class ModelUser extends Model {
    private $user_id;
    private $username;
    private $password;

    /**
     * constructeur de la classe ModelUser
     * $user_id INT numero de l'identifiant d'utilisateur
     * $username STRING le nom d'utilisateur
     * $password STRING le mot de passe
     */
    //constructeur
    public function __construct($user_id, $username, $password) {
        $this->utilisateur_id = $user_id;
        $this->utilisateur_nom = $username;
        $this->mot_de_passe = $password;
    }

	//fonction de sélectionner toutes les colonnes de la table par le nom d'utilisateur
	public static function getUser($username) {
       try {
            $sql = "SELECT * FROM utilisateur WHERE utilisateur_nom='".$username."';";
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

	//méthode de modifier le mot de passe d'un utilisateur
    public static function updatePwd($password, $user_id) { 
        $sql = "UPDATE utilisateur SET mot_de_passe = :tag_pwd WHERE utilisateur_id = :tag_userId ";
        $bdd = new Model();
        $req_prep = $bdd::$pdo->prepare($sql);
        $values = array(
            "tag_pwd"=>$password,
            "tag_userId"=>$user_id
        );
        $req_prep->execute($values);
    }

}
