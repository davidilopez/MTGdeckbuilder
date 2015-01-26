<?php
    function insertIntoPrefs($conn, $preferences){
        
        foreach($preferences as $card) {
            //****escape ' for database use****
            if(strpos($card, "'")){
                $card = str_replace("'", "''", $card);
            }
            
            //check if card exists in prefs
            $result = $conn->query("select count(*) from preferences where name = '$card'");     
            while($count_ = $result->fetch_assoc()) {
                foreach($count_ as $value){
                    $count = $value;
                }
            }
            
            if($count <= 0){
                //****add to database****
                $query = "insert into preferences select * from cards where name = '$card'";
                $conn->query($query);
            }
        }
    }
?>