<?php

    function initializeManaArray(){
        $totalManaArray = array(
            "W" => 0,
            "U" => 0,
            "B" => 0,
            "R" => 0,
            "G" => 0,
            "universal" => 0
         );
        return $totalManaArray;
    }

    function initializeManaCurve(){
        
        $manaCurve = array(
        "0" => 10,
        "1" => 2,
        "2" => 6,
        "3" => 5,
        "4" => 4,
        "5" => 4,
        "6+" => 2
    );
        return $manaCurve;
    }



?>