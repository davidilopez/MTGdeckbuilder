# MTGdeckbuilder
Final project for the course Knowledge Engineering 2014/15, VU Amsterdam. This system creates a Magic: The Gathering sealed deck based on basic deck-building principles and crowdsourced ratings of the cards.

- The database is created using createDatabase.php and using classes from /php/createDB, and from /php/general
- The Main page (index.php) loads all classes from /php/index and uses classes from /php/general. This page is used to get the 
  user's input and preferences. It is an web interface that displays the best cards from the pool. Cards are inputted either 
  using the dropdown menus, or the text field using a specific format (# card name \n) (e.g. 2 Ponyback Brigade (return)). The
  players pool is displayed in the 'your pool' section, which can also be used to remove cards. 
- When calculate is pressed, the inferences are started and deck.php is loaded. This page loads all classes needed for inference. 
  these classes are inside /php/deck. 
- Other folders are used for layout (/fonts, /css)
- The pages index.php and deck.php act as view & controllers. 
