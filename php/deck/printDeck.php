<?php
    function printDeck($conn){
        $cards = $conn->query("select * from deck order by colors desc, name asc");
        $i = 1;
        if ($cards->num_rows > 0){
            echo "<div class='row'>";
            while($card = $cards->fetch_assoc()) {
                echo "<div class='col-md-2'>";
                $name = $card['name'];
                $colors = $card['manaCost'];
                
                //****escape ' for html post use****
                if(strpos($card['name'], "'")){
                    $name = str_replace("'", "&#39", $card['name']);
                }
                
                echo "".$i. ". " . $name ."";
                echo "<img src='http://mtgimage.com/card/" . $name . ".jpg' width='100%' height='100%' class='cardDimensions' /><br>";
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