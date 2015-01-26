<?php
        function addPrefsToDeck($conn){
                $conn->query('insert into deck select * from preferences');
                
                $cards = $conn->query("select * from preferences");
                if ($cards->num_rows > 0){
                        while($card = $cards->fetch_assoc()) {
                               
                               $name = $card['name'];
                               //****escape ' for database use****
                                if(strpos($name, "'") !== false){
                                  $name = str_replace("'", "''", $name);
                                }
                                
                                $conn->query("delete from ownedCards where name = '$name' limit 1"); 
                        } 
                }
                
                
             
        }
        
        
        function addPrefsMana($conn, $totalManaArray){
                $cards = $conn->query("select * from preferences");
                if ($cards->num_rows > 0){
                        while($card = $cards->fetch_assoc()) {
                                $manaCost = explode("}", $card['manaCost']);
                                foreach ($manaCost as $mana) {
                                 $totalManaArray = addManaToTotal($mana, $totalManaArray);
                                }
                        } 
                }
                return $totalManaArray;
        }
        
        
        function returnPrefsToPool($conn){
                $conn->query('insert into ownedCards select * from preferences');
        }



?>