<?php
    function getPrefs($conn, $prefArray){
        foreach($prefArray as $card) {
           //****escape ' for database use****
           if(strpos($card, "'")){
               $card = str_replace("'", "''", $card);
           }

           //****add to database****
            $query = "insert into preferences select * from cards where name = '$card'";
            $conn->query($query);
       }   
    }
?>