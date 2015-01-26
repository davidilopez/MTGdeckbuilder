
<?php

function dbConnect($database){
        $conn = new mysqli('localhost', 'root');
        $conn->query("use $database");
        return $conn;
    }
    
    
    ?>