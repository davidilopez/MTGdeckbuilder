<?php
   /*Counts the creatures in preference table*/
   function countCreatureInPrefs($conn, $colors){
      $query = "select count(*) from preferences where (type like 'creature'
                                                         or type like 'legendary'
                                                         or type like '%creature%'
                                                         or type like '%artifact%'
                                                         or type like '%planeswalker%'
                                                         or type like '%summon%')
                                                         and (colors not like '%" .$colors. "%')";
      $cards = $conn->query($query);
      while($card = $cards->fetch_assoc()) {
         foreach($card as $value){
            $creatureCount = $value;
         }
      }
      return $creatureCount;
   }
   
   
   /*Counts the spells in preference table*/
   function countSpellsInPrefs($conn, $colors){
      $query = "select count(*) from preferences where (type like '%instant%' 
                                                         or type like '%enchantment%'
                                                         or type like '%sorcery%')
                                                         and (colors not like '%" .$colors. "%')";
      
      $cards = $conn->query($query);
      while($card = $cards->fetch_assoc()) {
         foreach($card as $value){
          $spellsCount = $value;
         }
      }
      return $spellsCount;
   }

?>





