<?php

function addMana($conn, $database){
 
    echo "adding mana <br>";
   
    function addToDb($manaValue, $name, $conn){
        if(strpos($name, "'")){  
           $name = str_replace("'", "''", $name);
        }
         $result = $conn->query("SELECT * FROM cards WHERE name = '$name'");
         if ($result->num_rows == 0){
             echo "No field exists for " .$name. "<br>";
         } else {
             $quer = "UPDATE cards SET givesMana = '$manaValue' WHERE name = '$name'";
             $conn->query($quer);
             //echo "adding ". $name. " with mana " .$manaValue. " <br>";
         }
        
    };
    //Get json from all cards
    $content = file_get_contents("php/createDB/AllCards-x.json");
    $parsed = json_decode($content,true);
    $i = 0;
    
    //loop over all cards
    foreach($parsed as $cards){
        
        $totalMana = "";
    
        //parse text
        if (array_key_exists('text', $cards)){
            if(strpos($cards['text'], "mana pool") && strpos($cards['text'], "Add")){
                $text = explode("." , $cards['text']);
                foreach($text as $snippet){
                   if(strpos($snippet, "Add")){
                       
                       //if there are no {} values in text, the string "color" is used to match on
                       if(strpos($snippet, "color")){
                           
                           $substring = explode("Add" , $snippet);
                           $substring2 = str_replace("mana pool", "pool", $substring[1]);
                           $mana = explode("mana", $substring2);
                           
                           //check what value the string has
                           if(strpos($mana[0], "four")){
                               $totalMana = "4";
                           } elseif(strpos($mana[0], "three")){
                               $totalMana = "3";
                           } elseif(strpos($mana[0], "two")){
                               $totalMana = "2";
                           } else{
                               $totalMana = "1";
                           }
                           addToDb($totalMana, $cards['name'], $conn);
                       }
                       
                       //if there are {} values in text
                       else {
                           $substring = explode("Add", $snippet);
                           if (strpos($substring[1], "}")){
                               $toUse = explode("}", $substring[1]);
                               foreach($toUse as $use){
                                   if (strpos($use, "{")){
                                       $mana = explode("{", $use);
                                       $totalMana = $totalMana . $mana[1]. ", ";
                                   }
                               }
                                addToDb($totalMana, $cards['name'], $conn);
                           }
                       } 
                   }
                }
            }
        }
    }
}
?>
