<?php

function addManaToTotal($mana, $totalManaArray){

    if (strpos($mana, "G") !== false) {
        $totalManaArray['G'] += 1;
    } else if (strpos($mana, "W") !== false) {
        $totalManaArray['W'] += 1;
    } else if (strpos($mana, "U") !== false) {
        $totalManaArray['U'] += 1;
    } else if (strpos($mana, "B") !== false) {
        $totalManaArray['B'] += 1;
    } else if (strpos($mana, "R") !== false) {
        $totalManaArray['R'] += 1;
    } else {
        $colorless = $mana;
        $colorless = preg_replace("/[^0-9]/", "", $colorless);
        $totalManaArray['universal'] += $colorless;
    }
    return $totalManaArray;
}


function removeMana($mana, $totalManaArray){

    if (strpos($mana, "G") !== false) {
        $totalManaArray['G'] -= 1;
    } else if (strpos($mana, "W") !== false) {
        $totalManaArray['W'] -= 1;
    } else if (strpos($mana, "U") !== false) {
        $totalManaArray['U'] -= 1;
    } else if (strpos($mana, "B") !== false) {
        $totalManaArray['B'] -= 1;
    } else if (strpos($mana, "R") !== false) {
        $totalManaArray['R'] -= 1;
    } else {
        $colorless = $mana;
        $colorless = preg_replace("/[^0-9]/", "", $colorless);
        $totalManaArray['universal'] -= $colorless;
    }

    return $totalManaArray;
}


function manaNeeded($manaArray, $totalManaArray){

    $manaLength = sizeof($manaArray) - 1;

    $needed = 0;
    foreach($manaArray as $mana){

        $mana = preg_replace('/\s+/', '', $mana);

        if ($mana != ""){
            if (is_numeric($mana) && $totalManaArray['universal'] > 0){
                $needed += 1;
            } elseif($totalManaArray[$mana]){
                $needed += 1;
            }
        }
    }

    if ($needed >= $manaLength){
        return true;
    } else {
        return false;
    }
}


function producesCorrectMana($givenMana, $neededMana){

    if(strpos($givenMana, ",") !== false ){
        $givenManaArray = explode(",",$givenMana);
        foreach($givenManaArray as $mana){
            if(strpos($givenMana, "R") !== false && !in_array($neededMana, "Red")){
                return false;
            } elseif(strpos($givenMana, "G") !== false && !in_array($neededMana, "Green")){
                return false;
            } elseif(strpos($givenMana, "U") !== false && !in_array($neededMana, "Blue")){
                return false;
            }elseif(strpos($givenMana, "B") !== false && !in_array($neededMana, "Black")){
                return false;
            }elseif(strpos($givenMana, "W") !== false && !in_array($neededMana, "White")){
                return false;
            } else {
                return true;
            }
        }
    }
    else {
        return true;
    }
}