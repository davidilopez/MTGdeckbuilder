<?php
    function getValuesFromDropdowns($conn, $postArray, $nameArray){
        foreach($nameArray as $name){
            if (isset($postArray[$name])){
                 $name2 = $name;
                 //****escape ' for database use****
                 if(strpos($name2, "'") !== false){
                    $name2 = str_replace("'", "''", $name2);
                 }
                 if(strpos($name2, "_") !== false){
                    $name2 = str_replace("_", " ", $name2);
                 }
                 
                for($j=0; $j < (int)$postArray[$name]; $j++){
                    
                    $result = $conn->query("select count(*) from ownedCards where name = '$name2'");
                    while($count_ = $result->fetch_assoc()) {
                        foreach($count_ as $value)
                            $count = $value;
                     }
                    
                    if($count < 4){
                        $query = "insert into ownedCards select * from cards where name = '$name2'";
                        $conn->query($query);
                    } else {
                        echo "Maximum amount per card exceeded at card " .$name2. "<br>";
                        break 1;
                    }
                }
             }
        }
    }
?>