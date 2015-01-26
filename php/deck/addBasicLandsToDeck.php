<?php

function addLands($totalManaArray, $conn){
    $percentages = array(
           "W" => 0,
           "U" => 0,
           "B" => 0,
           "R" => 0,
           "G" => 0,
       );
        
        
    $total = 0;
    
    foreach($totalManaArray as $value){
        if(array_search($value,$totalManaArray) != 'universal'){
            $total += $value;
        }
    }
    
    $key = 0;
    $newArray = array_keys($totalManaArray);
    foreach($totalManaArray as $value){
        if($newArray[$key] != 'universal'){
            $percentages[$newArray[$key]] = $value/$total;
        }
        $key +=1;
    }
    arsort($percentages);
    
    foreach($percentages as $color){
        if ($color == 0){
                unset($percentages[array_search($color, $percentages)]);
            }
    }
    
    $result = $conn->query("select count(*) from deck");
        while($result2 = $result->fetch_assoc()) {
             foreach($result2 as $value){
                $count = $value;
        }
    }
    
    
    $newArray = array_keys($percentages);
    $key = 0;
    
    foreach($percentages as $color){
        
        $numberOfCards = round(17 * $color);
        
        if($newArray[$key] == "B"){
             for($i = 0; $i < $numberOfCards; $i++){
                if($count < 40){
                    $conn->query("insert into deck select * from cards where name = 'Swamp'");
                    $count += 1;
                }
             }
        }
        
        if($newArray[$key] == "U"){
             for($i = 0; $i < $numberOfCards; $i++){
                if($count < 40){
                    $conn->query("insert into deck select * from cards where name = 'Island'");
                    $count +=1;
                }
             }
        }
        
        if($newArray[$key] == "W"){
             for($i = 0; $i < $numberOfCards; $i++){
                if($count < 40){
                    $conn->query("insert into deck select * from cards where name = 'Plains'");
                    $count +=1;
                }
             }
        }
        
        if($newArray[$key] == "G"){
             for($i = 0; $i < $numberOfCards; $i++){
                if($count < 40){
                    $conn->query("insert into deck select * from cards where name = 'Forest'");
                    $count +=1;
                }
             }
        }
        
        if($newArray[$key] == "R"){
             for($i = 0; $i < $numberOfCards; $i++){
                if($count < 40){
                    $conn->query("insert into deck select * from cards where name = 'Mountain'");
                    $count += 1;
                }
             }
        }
        
        $key ++;
    }
    
    asort($percentages);
    
    
      
    while($count < 40){
        
        $smallestValue = reset($percentages);
        $smallestColor = array_search($smallestValue, $percentages);
        
      
        if(array_search($color, $percentages) == "B"){
             $conn->query("insert into deck select * from cards where name = 'Swamp'");
        }
        if(array_search($color, $percentages) == "U"){
             $conn->query("insert into deck select * from cards where name = 'Island'");
        }
        if(array_search($color, $percentages) == "W"){
             $conn->query("insert into deck select * from cards where name = 'Plains'");
        }
        if(array_search($color, $percentages) == "G"){
             $conn->query("insert into deck select * from cards where name = 'Forest'");
        }
        if(array_search($color, $percentages) == "R"){
             $conn->query("insert into deck select * from cards where name = 'Mountain'");
        }
        $count++;
    }
}
?>