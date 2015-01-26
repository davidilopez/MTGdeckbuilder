<?php
    function printDropdown($nameArray){
        $i = 1;
        foreach($nameArray as $name){
            $name2 = $name;
            if(strpos($name, "_") !== false){
                $name2 = str_replace("_", " ", $name);
            }
            if(strpos($name, "'") !== false){
                $name = str_replace("'", "&#39", $name);  
            }
             echo "<select name='".$name. "'>  <option disabled selected> -- </option>
                                                            <option value=0>0</option>
                                                            <option value=1>1</option>
                                                            <option value=2>2</option>
                                                            <option value=3>3</option>
                                                            <option value=4>4</option>
                                                            </select>".$i . ".  ".  $name2 ."<br>";  
            $i++;
        }
    }
?>