<?php

function addSpellsToDeck($conn, $totalManaArray, $spellsNeeded, $colors, $colorsArray){
    
    //****select spells
    $cards = $conn->query("select * from ownedCards where (type like '%instant%' or
                       type like '%enchantment%'
                       or type like '%sorcery%')
                       and (colors not like '%" .$colors. "%')
                       order by rating desc");
    //******

    if ($cards->num_rows > 0){
        while($card = $cards->fetch_assoc()) {

            if ($spellsNeeded > 0) {
                if ($card['manaCost'] != null && producesCorrectMana($card['givesMana'], $colorsArray)) {
                    //get highest rated card with manacost
                    //****check what manacost the card has, and add to totalManaArray***
                    $manaCost = explode("}", $card['manaCost']);
                    foreach ($manaCost as $mana) {
                        $totalManaArray = addManaToTotal($mana, $totalManaArray);
                    }
                }

                if( $card['givesMana'] != "0" ){

                    echo $card['name'];
                    if(strpos($card['givesMana'], ",") !== false){
                        $manaArray = explode(",",$card['givesMana']);
                    } else{
                        $manaArray[0] = $card['givesMana'];
                    }
                    foreach($manaArray as $mana){
                        if (strpos($mana, " ")){
                            $mana = str_replace(" ", "", $mana);
                        }
                        $totalManaArray = removeMana($mana, $totalManaArray);
                    }
                }

                $name = $card['name'];
                if(strpos($name, "'") !== false){
                    $name = str_replace("'", "''", $name);
                }
                $conn->query("insert into deck select * from ownedCards where name like '" . $name. "' limit 1");
                $spellsNeeded -= 1;
            }
        }

    }
    return array($totalManaArray, $spellsNeeded);
}
?>