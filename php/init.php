<?php

#   include classes
    foreach (glob('php/classes/*.class.php') as $class_filename){
        include($class_filename);
    }

?>