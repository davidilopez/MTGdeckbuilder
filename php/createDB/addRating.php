<?php

function addRating($conn, $database){
   
    echo "Adding scores (might take a while)";    
    //get scores from text file
    $content = file_get_contents("php/createDB/magicScores.txt");
    $lines = explode("\n", $content);
    
    //loop over all lines
    foreach($lines as $line){
        
        //parse every line
        if(strpos($line, ">")){
            $line2 = explode(">", $line);
            $line3 = explode(": ", $line2[1]);
            $name = $line3 [0];
            $score = str_replace(";", "", $line3[1]);
            
            //Otherwise the values with an ' aren't added, ' must be replaced with ''
            if(strpos($name, "'")){
                $name = str_replace("'", "''", $name);
            }
            
            //check if name exists    
            $result = $conn->query("SELECT * FROM cards WHERE name = '$name'");
            if ($result->num_rows == 0){
                echo "No field exists for " .$name. "<br>";
            } else {
                $quer = "UPDATE cards SET rating = '$score' WHERE name = '$name'";
                $conn->query($quer);
                echo "Adding score . " .$score. " to field " .$name. "<br>";
            }
        }
    }
    
}
?>