<?php

Class File {

	//fonction de déplacer dans un fichier
    public static function build_path($path_array) {
        $SLASH = DIRECTORY_SEPARATOR;
        $ROOT_FOLDER = __DIR__ . $SLASH . "..";
        
        return $ROOT_FOLDER . $SLASH . join($SLASH, $path_array);
    }

}
?>


