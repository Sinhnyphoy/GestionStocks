<?php
	include("head.php");
	include("header.php");
	
        if(static::$object!=null) {
            $filepath = File::build_path(array("view", static::$object, "$view.php"));
            require $filepath;
        } else {
            $filepath = File::build_path(array("view", "$view.php"));
            require $filepath;
        }
								
	include("footer.php"); 

