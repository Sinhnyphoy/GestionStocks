<?php

$ROOT_FOLDER = __DIR__;
$SLASH = DIRECTORY_SEPARATOR;

//inclure la classe File
require_once $ROOT_FOLDER . $SLASH . 'lib' . $SLASH . 'File.php';

//inclure sa fonction de déplacement dans le contrôleur "Router.php"
require_once File::build_path(array("controller", "router.php"));



