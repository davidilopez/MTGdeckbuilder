<!DOCTYPE html>
<html>
    <head>
        <link href="css/main.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        
        <?php
            include_once('php/general/dbConnect.php');
            include_once('php/deck/insertIntoPrefs.php');
            include_once('php/general/dbName.php');
            $conn = dbConnect($DATABASENAME);
            if( isset($_POST['preferences']) && is_array($_POST['preferences']) && isset($_POST['Calculate']) ) {
                 insertIntoPrefs($conn, $_POST['preferences']);
            }
        ?>
    
    </head>
    
    <body>
        <form action='index.php' method='post'>
            <input type='Submit' name='Deck' value='Return'>
        </form>
        
        <?php
            include_once('php/general/dbConnect.php');
            
            include_once('php/deck/addPrefsToDeck.php');
            include_once('php/deck/colorsCount.php');
            include_once('php/deck/counter.php');
            include_once('php/deck/totalManaArray.php');
            include_once('php/deck/addBasicLandsToDeck.php');
            include_once('php/deck/cmcNeeded.php');
            include_once('php/deck/initializeArrays.php');
            include_once('php/deck/addSpellsToDeck.php');
            include_once('php/deck/addCreaturesToDeck.php');
            include_once('php/deck/addSpecialLands.php');
            include_once('php/general/dbName.php');
            
            $conn = dbConnect($DATABASENAME);
            $conn->query("drop table if exists deck");
            $conn->query("CREATE TABLE if not exists deck LIKE preferences");
            list($colors, $colorsArray, $spellsCount, $creatureCount) = colorsCount($conn);
            /*Count creatures and spells from selected table*/
            $creaturesNeeded = 13 - countCreatureInPrefs($conn, $colors);
            $spellsNeeded = 10 - countSpellsInPrefs($conn, $colors);
            
            if ($creatureCount <= 13 || $creatureCount + $spellsCount <= 23) {
            echo "You don't have enough cards with these colors. Please pick something else.";
            } else {
            
            //keep track of mana in $totalManaArray
            $totalManaArray = initializeManaArray();
            $manaCurve = initializeManaCurve();
            
            //first, add the preferences with their mana
            addPrefsToDeck($conn);
            $totalManaArray = addPrefsMana($conn, $totalManaArray);
            
            
            //second, add spells to deck
            list($totalManaArray, $spellsNeeded) = addSpellsToDeck($conn, $totalManaArray, $spellsNeeded, $colors, $colorsArray);
            
            //calculate needed creatures
            $creaturesNeeded = $creaturesNeeded + $spellsNeeded;
            
            //third, add creatures to deck
            list($totalManaArray, $creaturesNeeded) = addCreaturesToDeck($conn, $totalManaArray, $creaturesNeeded, $colors, $colorsArray, $manaCurve);
            
            //fourth, add special lands and artifacts that give mana
            list($totalManaArray) = addSpecialLands($conn, $totalManaArray);
            
            //last, add basic lands
            addLands($totalManaArray, $conn);
            
            returnPrefsToPool($conn);
            }
        ?>
        
        <form action='index.php' method='post'>
            <?php
                include_once('php/deck/printDeck.php');
                include_once('php/general/dbConnect.php');
                include_once('php/general/dbName.php');
                $conn = dbConnect($DATABASENAME);
                printDeck($conn);
            ?>
        </form>
    </body>
</html>