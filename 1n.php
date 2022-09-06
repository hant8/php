<?php

    $password = 12345723732;
    $password = (string)$password;
    $password = str_split($password);
    
    function enum($password){

        var_dump(array_shift($password));
		
		if (count($password) !== 0) {
			enum($password);
        }

    }
    enum($password);
?>