
<?php

function dbConnect($database){
        $conn = new mysqli('david-server', 'root', 'Spector2702');
        $conn->query("use $database");
        return $conn;
    }
    
    
    ?>