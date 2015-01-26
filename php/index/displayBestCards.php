<?php
    function displayBestCards($conn){
        $cards = $conn->query("select distinct* from ownedCards order by rating desc");
        $i = 1;
        if ($cards->num_rows > 0){
            echo "<div class='row'>";
            while($card = $cards->fetch_assoc()) {
                echo "<div class='col-md-3'>";
                $name = $card['name'];
                $colors = $card['manaCost'];
                //****escape ' for html post use****
                if(strpos($card['name'], "'")){
                    $name = str_replace("'", "&#39", $card['name']);
                }
                if ($i <= 12) {
                    echo "<h4><input type='checkbox' name='preferences[]' value='" .$name. "'>".$i. ". " . $name . ": " .$card['rating']. "</h4>";
                    echo "<img src='http://mtgimage.com/card/" . $name . ".jpg' width='100%' height='100%' class='cardDimensions' /><br>";
                }
                echo "</div>";
                $i++;
            }
            echo "</div>";
        }
        else{
            echo "Nothing added yet <br><br>";
        } 
    }
?>