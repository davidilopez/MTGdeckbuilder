<?php

    function colorsCount($conn){
    $creatureCount2 = 0;
    $spellsCount2 = 0;
    
    $cards = $conn->query("select * from preferences ");
    $colorsArray = [];
    
    //****see what colors are inside preferences****
    if ($cards->num_rows > 0){
        while($card = $cards->fetch_assoc()) {
            
            if (strpos($card['colors'], ',') !== false){
                $colors = explode(",",$card['colors']);
            } elseif ($card['colors'] == ""){
                $colors = [];
            }
            else{
                $colors = [$card['colors']];
            }
            foreach($colors as $color){
                if (! in_array($color, $colorsArray)){
                    array_push($colorsArray, $color);
                }
            }
        }
    }
    else{
       echo "nothing added";
    }
    $colorsLeft = ['Red', 'White', 'Blue', 'Black','Green'];
    $i = 0;
    foreach($colorsArray as $color){
        $key = array_search($color, $colorsLeft);
        unset($colorsLeft[$key]);
    }
    //****see if there are enough cards with these colors****
    $colors = implode("%' AND colors not LIKE '%", $colorsLeft);
    $query = "Select count(*) from ownedCards where (type like '%instant%' or
                          type like '%enchantment%'
                        or type like '%artifact%'
                          or type like '%sorcery%')
                          and (colors not like '%" .$colors. "%')";
    $spells = $conn->query($query);
    while($card = $spells->fetch_assoc()) {
        foreach($card as $value)
        $spellsCount = $value;
    }
    
    $query2 = "Select count(*) from ownedCards where (type like '%legendary%'
                          or type like '%creature%'
                          or type like '%planeswalker%'
                          or type like '%summon%')
                          and (colors not like '%" .$colors. "%')";
    $creatures = $conn->query($query2);
    while($card = $creatures->fetch_assoc()) {
        foreach($card as $value)
        $creatureCount = $value;
    }
    return array($colors, $colorsArray, $spellsCount, $creatureCount);
    }
?>