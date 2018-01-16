<?php

require_once File::build_path(array('config', 'configuration.php'));
require_once File::build_path(array('config', 'define.php'));

class Model {

    public static $pdo;

	//méthode d'initier de connecter à la base des données
    public static function Init() {
        $hostname = Configuration::getHostname();
        $database_name = Configuration::getDatabase();
        $login = Configuration::getLogin();
        $password = Configuration::getPassword();
        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if(Configuration::getDebug()) {
                // affiche un message d'erreur
                echo $ex->getMessage(); 
                die();
            }
        }
    }
    
    public function __construct() {
        Model::Init();
    }
    
	//fonction globale de sélectionner toutes les colonnes de n'importe quelle table
    public static function selectAll() { //fetch obj
        try {
            $table_name = ucfirst(static::$object);
            $class_name = "Model" . $table_name;
            $bdd = new Model();
            $sql = "SELECT * FROM {$table_name}";
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
