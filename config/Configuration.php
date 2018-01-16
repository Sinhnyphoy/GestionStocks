<?php

class Configuration {

    static private $databases = array(
        'hostname' => 'localhost', //'10.188.160.92',
        'database' => 'gestion_stocks',
        'login' => 'root',
        'password' => 'root'
    );

    static public function getLogin() {
        return self::$databases['login'];
    }

    static public function getDatabase() {
        return self::$databases['database'];
    }

    static public function getPassword() {
        return self::$databases['password'];
    }

    static public function getHostname() {
        return self::$databases['hostname'];
    }
   
    // la variable debug est un boolean
    static private $debug = True; 
    
    static public function getDebug() {
    	return self::$debug;
    }
	
}
