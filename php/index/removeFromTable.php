<?php
    function removeFromTable($conn, $array, $tableName){
        foreach($array as $value) {      
              //****escape ' for database use****
              if(strpos($value, "'")){
                  $value = str_replace("'", "''", $value);
              }
			  
			  
              $result = $conn->query("DELETE FROM $tableName WHERE name = '$value' limit  1");
          }
    }
?>