<?php
function addSpecialLands($conn, $totalManaArray){
    $query = "select * from ownedCards where (type like '%artifact%' or type like '%land%') and (givesMana not like '%0%') order by rating desc";
    $cards = $conn->query($query);



    echo "<br>";
    if ($cards->num_rows > 0){
        while($card = $cards->fetch_assoc()) {


            if(strpos($card['givesMana'], ",") !== false){
                $manaArray = explode(",",$card['givesMana']);
            } else{
                $manaArray[0] = $card['givesMana'];
            }

            if(manaNeeded($manaArray, $totalManaArray)){
                foreach($manaArray as $mana){
                    if (strpos($mana, " ") !== false){
                        $mana = str_replace(" ", "", $mana);
                    }
                    $totalManaArray = removeMana($mana, $totalManaArray);
                }

                //****escape ' for database use****
                $name = $card['name'];
                if(strpos($name, "'") !== false){
                    $name = str_replace("'", "''", $name);
                }
                $conn->query("insert into deck select * from ownedCards where name like '" .$name. "' limit 1");
            }
        }
    } return array($totalManaArray);
}




?>