<?php
    include_once('php/createDB/addRating.php');
    include_once('php/createDB/addMana.php');
    include_once('php/createDB/addCardsToDatabase.php');
    include_once('php/general/dbConnect.php');
    include_once('php/general/dbName.php');
     
    $conn = new mysqli('localhost', 'root');
    $conn->query("create database if not exists $DATABASENAME");
    $conn->query("use $DATABASENAME");
    addCardsToDatabase($conn, $DATABASENAME);
    addMana($conn, $DATABASENAME);
    addRating($conn, $DATABASENAME);
    
    $conn->close();
    
?>