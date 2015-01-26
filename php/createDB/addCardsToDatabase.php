<?php
function addCardsToDatabase($conn, $database){
          
  $conn->query("create Table Cards(name varchar(30), type varchar(30), colors varchar(30), rarity varchar(30), multiverseid int, rating float, givesMana varchar(30), cmc varchar(30), manaCost varchar(30))")  ;      
  
  //get contents from json (values of all cards)
  $content = file_get_contents("php/createDB/AllSets-x.json");
  $parsed = json_decode($content,true);
  echo "inserting (till 15001): <br>";
  $i = 0;
  //loop over cards to add their values
  foreach($parsed as $cards){
  
   foreach($cards['cards'] as $card){
    
    
    $name = $card['name'];
    
    //replace ' for database use
    if(strpos($name, "'")){  
     $name = str_replace("'", "''", $name);
    }
    
    //check if value doesn't already exist
    $result = $conn->query("SELECT * FROM cards WHERE name = '" . $name ."'");
    if ($result->num_rows == 0){
    
     
     echo $i . " ";
     //check if card has colors
     $colors = "";
     if (array_key_exists('colors', $card)){
     $colors = implode(",", $card['colors']);
     }
     
     $types = "";
     if (array_key_exists('types', $card)){
     $types= implode(",", $card['types']);
     }
     
     
     $cmc = "";
     if (array_key_exists('cmc', $card)){
     $cmc = $card['cmc'];
     }
     
      $multiverseId= "";
     if (array_key_exists('multiverseid', $card)){
     $multiverseId = $card['multiverseid'];
     }
     
     
     //check if card has manaCost
     $manaCost = "";
     if (array_key_exists('manaCost', $card)){
      $manaCost = $card['manaCost'];
     }
     $quer = "insert into Cards (name, type, colors, rarity, multiverseid, rating, givesMana, cmc, manaCost) values ('" .$name. "','" .$types. "','" .$colors. "','" .$card['rarity']. "','" .$multiverseId. "','0', '0','" .$cmc."','" .$manaCost. "')";
     $conn->query($quer);
     $i++;
    }
    
   }
  
  }
  echo "<br>database filled<br>";

 }
?>

