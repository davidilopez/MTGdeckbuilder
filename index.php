<!DOCTYPE html>
<html>
	<head>
		<link href="css/main.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">

		<script language="JavaScript">
		
			//****select all function for pool****
			function toggle(source) {
				checkboxes = document.getElementsByName('ownedCards[]');
				for(var i=0, n=checkboxes.length;i<n;i++) {
					checkboxes[i].checked = source.checked;
				}
			}
		</script>
		
		<?php
		
			include_once('php/general/dbConnect.php');
		
			include_once('php/index/createNameArray.php');
			include_once('php/index/addTextFieldToDatabase.php');
			include_once('php/index/removeFromTable.php');
			include_once('php/index/getValuesFromDropdowns.php');
			include_once('php/index/getPrefs.php');
			include_once('php/general/dbName.php');
			
			$conn = dbConnect($DATABASENAME);
			$nameArray = createNameArray($conn);
			
			
			
			//**** get cards from dropdown and add to ownedCards****
			$conn->query("create Table if not exists ownedCards like cards") ;
			if(isset($_POST['Submit'])){
				getValuesFromDropdowns($conn, $_POST, $nameArray);
			}
			//get cards from textfield and add to database
			if(isset($_POST['cards']) && isset($_POST['SubmitField'])){
				addTextFieldToDatabase($conn, $_POST['cards']);
			}
			
			
			
			$conn->query("create table if not exists preferences like cards");
			//****PREFERENCES:: check if calculate button is pressed and add cards to Preferences****
			$conn->query("truncate table preferences");
			if( isset($_POST['preferences']) && isset($_POST['Calculate']) ) {
				getPrefs($conn, $_POST['preferences']);
			}
			
			
			//****OWNEDCARDS:: check if remove button is pressed and remove cards from ownedCards***
			if( isset($_POST['ownedCards']) && isset($_POST['Remove2']) ) {
			
				removeFromTable($conn, $_POST['ownedCards'], 'ownedCards');
			}
			
			//****close connection****
			$conn->close();
		?>
	</head>
	
	<body>
		<div class="popover-title">
			<h1>Magic: The Gathering Deck Builder</h1>
		</div>
		
		<div class="row">
			<div class="col-md-2" id="input">
				<h3>Input the cards you got:</h3>
				<p>You can do it by text:</p>

				<form action='index.php' method='post' id='cardsform'>
					<input type='submit' name='SubmitField' value='Submit'>
				</form>
				<textarea name="cards" form="cardsform" placeholder="1 Black Lotus" rows="10"></textarea>

				<p><br>Or you can select the cards from the database:</p>
				<div id="inputCards">
				<form action='index.php' method='post'>
				
					<?php
						include_once('php/index/printDropdown.php');
						printDropdown($nameArray);
					?>
					</div>
					<input type='submit' name='Submit' value='Submit'>
				</form>
			
			</div>
			
			<div class="col-md-2" id="pool">
				<h3>This is the pool you received:</h3>
				<div id="poolCards">
				<form action='index.php' method='post'>
					<input type='checkbox' name='ownedCards[]' onClick='toggle(this)' /> Select All<br/>
					<?php
					
						//****create form for displaying own collection and removing cards from own collection****
						include_once('php/index/printOwnedCards.php');
						include_once('php/general/dbName.php');
						$conn = dbConnect($DATABASENAME);
						printOwnedCards($conn);
						
					?>
					</div>
					<input type='Submit' name='Remove2' value='Remove'>

				</form>
			</div>
			
			<div class="col-md-8">
				<h3>These are the best 12 cards in your pool.</h3>
				<p>Select the card or cards you would like to use. The color(s) of these cards will be used for your entire deck.</p>
				<form action='deck.php' method='post'>
				<?php
					/*Display the top 12 cards*/
					
					//****create form for displaying own collection and removing cards from own collection****
					include_once('php/index/displayBestCards.php');
					include_once('php/general/dbName.php');
					$conn = dbConnect($DATABASENAME);
					displayBestCards($conn);
				?>
					<input type='Submit' name='Calculate' value='Calculate'>
				</form>
			</div>
		</div>
	</body>
</html>

