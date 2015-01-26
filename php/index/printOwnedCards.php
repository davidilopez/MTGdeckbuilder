<?php
    function printOwnedCards($conn){
        $cards = $conn->query("select * from ownedCards order by name asc");
			$i = 1;
        if ($cards->num_rows > 0){
           while($card = $cards->fetch_assoc()) {
               $name = $card['name'];
               $mvid = $card['multiverseid'];
               //****escape ' for html post use****
               if(strpos($card['name'], "'")){
                   $name = str_replace("'", "&#39", $card['name']);
               }
               echo "<input type='checkbox' name='ownedCards[]' value='" .$name. "'> " .$i.
                   ". <a href='http://gatherer.wizards.com/Pages/Card/Details.aspx?multiverseid=" .$mvid.
                   "' target='_blank'>" .$name." </a> has rating: " .$card['rating']. "<br>";
               $i++;
           }
        }else{
            echo "Nothing added yet <br><br>";
	}
    }
?>
    