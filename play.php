<?php 
include 'inc/Game.php';
include 'inc/Phrase.php';

$phrase = new Phrase();
$game = new Game($phrase);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Phrase Hunter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>

	<body>
		<div class="main-container">
			<h2 class="header">Phrase Hunter</h2>
            <?php 
			echo $phrase->addPhraseToDisplay(); 
			echo $game->displayKeyboard();
			?>
		</div>

	</body>
</html>

