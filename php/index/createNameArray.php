<?php
    function createNameArray($conn){
       $nameArray = [];
       $query = "select name from cards order by name";
       $result = $conn->query($query);
       if ($result->num_rows > 0) {
           while($card = $result->fetch_assoc()) {
		$name = $card['name'];
                      
	       if(strpos($name, " ")!== false){
                   $name = str_replace(" ", "_", $name);
               }
		array_push($nameArray, $name);
	   }
       }
       return $nameArray;
    }
?>