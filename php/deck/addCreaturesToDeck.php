<?php
    function addCreaturesToDeck($conn, $totalManaArray, $creaturesNeeded, $colors, $colorsArray, $manaCurve){
        
            //***** Get 13 creatures****
        $query = "select * from ownedCards where (type like '%legendary%'
                           or type like '%creature%'
                           or type like '%planeswalker%'
                           or type like '%summon%')
                           and (colors not like '%" .$colors. "%')
                           order by rating desc";
    
        $cards = $conn->query($query);
    
        if ($cards->num_rows > 0){
            while($card = $cards->fetch_assoc()) {
    
                if ($creaturesNeeded > 0 && cmcNeeded($manaCurve, $card['cmc'])) {
    
                    $cmcArray = removeCmc($manaCurve, $card['cmc']);
                    if ($card['manaCost'] != null) {
                        //get highest rated card with manacost
                        //****check what manacost the card has, and add to totalManaArray***
                        $manaCost = explode("}", $card['manaCost']);
                        foreach ($manaCost as $mana) {
                            $totalManaArray = addManaToTotal($mana, $totalManaArray);
                        }
                    }
                    if( $card['givesMana'] != "0" ){
                        if(strpos($card['givesMana'], ",") !== false ){
                            $manaArray = explode(",",$card['givesMana']);
                        } else{
                            $manaArray[0] = $card['givesMana'];
                        }
                        foreach($manaArray as $mana){
                            if (strpos($mana, " ") !== false){
                                $mana = str_replace(" ", "", $mana);
                            }
                            //echo $mana . ",";
                            $totalManaArray = removeMana($mana, $totalManaArray);
                        }
                    }
                    //****escape ' for database use****
                    $name = $card['name'];
                    if(strpos($name, "'") !== false){
                        $name = str_replace("'", "''", $name);
                    }
                    $conn->query("insert into deck select * from ownedCards where name like '" . $name . "' limit 1");
                    $creaturesNeeded -= 1;
                }
    
            }
        } return array($totalManaArray, $creaturesNeeded);
    }



?>