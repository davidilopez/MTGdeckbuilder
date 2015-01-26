<?php
    function addTextFieldToDatabase($conn, $postedCards){
    $cards = explode("\n",$postedCards);
        foreach($cards as $card){
            $array = explode(" ", $card);
            

            //get number of cards to add
            $amount = $array[0];
            unset($array[0]);
            
            //get name of card
            $card = implode(" ", $array);
            $card = str_replace(array("\n", "\r"), "", $card);
            
            //****escape ' for database use****
            if(strpos($card, "'") !== false){
              $card = str_replace("'", "''", $card);
            }
          
            //add cards equal to amount of cards
            for($i = 0; $i<$amount; $i++){
                
                //check how many times card exists in ownedCards (can't be more than 4)
                $result = $conn->query("select count(*) from ownedCards where name = '$card'");     
                while($count_ = $result->fetch_assoc()) {
                    foreach($count_ as $value){
                        $count = $value;
                    }
                 }
                
                //add cards to database
                if($count < 4){
                    $query = "insert into ownedCards select * from cards where name = '" .$card. "'";
                    $conn->query($query);
               }
            }
        }
    }
?>