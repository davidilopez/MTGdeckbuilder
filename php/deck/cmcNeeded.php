<?php


function cmcNeeded($cmcArray, $cmc){
    if((int)$cmc >= 6){
        $cmc = "6+";
    }
    if($cmcArray[$cmc] <= 0){
        return false;

    } else return true;

}


function removeCmc($cmcArray, $cmc){
    if((int)$cmc >= 6){
        $cmc = "6+";
    }
    $cmcArray[$cmc] -=1;

    return $cmcArray;
}
