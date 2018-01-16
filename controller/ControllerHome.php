<?php

class ControllerHome {

    protected static $object = 'home';
	
    public static function controllerInvalide() {
        $view = "controllerInvalide";
        $pagetitle = "Error controller";
        require File::build_path(array("view", "view.php"));
    }
	
    public static function actionInvalide() {
        $view = "actionInvalide";
        $pagetitle = "Error action";
        require File::build_path(array("view", "view.php"));
    }

    public static function authentifier() {
        $view = 'login';
        $pagetitle = 'Connexion';
        require_once File::build_path(array("view", "$view.php"));
    }
}
