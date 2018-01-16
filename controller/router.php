<?php
require_once File::build_path(array("controller", "ControllerHome.php"));
require_once File::build_path(array("controller", "ControllerLogin.php"));
require_once File::build_path(array("controller", "ControllerMateriel.php"));
require_once File::build_path(array("controller", "ControllerMembre.php"));
require_once File::build_path(array("controller", "ControllerMaterielPret.php"));
require_once File::build_path(array("controller", "ControllerUser.php"));

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
} else {
    $controller = 'home';
}
$controller_class = "Controller" . ucfirst($controller);

if (!class_exists($controller_class)) {
    ControllerHome::controllerInvalide();
} else {

    if (isset($_GET['action'])) {
        if (method_exists($controller_class, $_GET['action'])) {
            $action = $_GET['action'];
            $controller_class::$action();
        } else {
            ControllerHome::actionInvalide();
		}
    }
    else {
		
        ControllerHome::authentifier();

    }  
}

