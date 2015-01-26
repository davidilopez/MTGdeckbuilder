<?php
    include_once('createDB/addRating.php');
    include_once('createDB/addMana.php');
    include_once('createDB/addCardsToDatabase.php');
    include_once('general/dbConnect.php');
    include_once('general/dbName.php');
    
    $conn = dbConnect("Magicdbtest");
    
    addCardsToDatabase($conn, $DATABASENAME);
    addMana($conn, $DATABASENAME);
    addRating($conn, $DATABASENAME);
?>