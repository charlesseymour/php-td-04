<?php
class Game 
{
	private $phrase;
	private $lives = 5;
	
	function __construct($Phrase) {
		$this->phrase = $Phrase;
	}
	
	/*function checkForWin() {
		$phraseLetters = array_unique(str_split(str_replace(' ', '',strtolower($this->$phrase->getPhrase()))));
		foreach ($phraseLetters as $phraseLetter) {
			if (!in_array($phraseLetter, $this->phrase->getSelected())) {
				return false;
			}
		}
		return true;
	}*/
	
	function checkForLose() {
		return $this->phrase->numberLost() >= $this->lives;
	}
	
	function checkForWin() {
		var_dump(array_intersect($this->phrase->getSelected(), $this->phrase->getLetterArray()));
		return count(array_intersect($this->phrase->getSelected(), $this->phrase->getLetterArray())) == 
			   count($this->phrase->getLetterArray());
	}
	
	function gameOver() {
		if ($this->checkForLose()) {
			return '<h1 id="overlay" class="lose">The phrase was: "' . $this->phrase->getPhrase() . '". Better luck next time!</h1>';
		} else {
			//return '<h1 id="game-over-message">Congratulations on guessing: "' . $this->phrase->getPhrase() . '"</h1>';
		}
	}
	
	function styleKey($key) {
		$keyHTML = "";
		if (in_array($key, $this->phrase->getSelected())) {
			if ($this->phrase->checkLetter($key)) {
				$keyHTML .= ' correct" style="background-color: green" disabled';
			} else {
				$keyHTML .= ' incorrect" style="background-color: red" disabled';
			}
		} else {
			$keyHTML .= '"';
		}
		return $keyHTML;
	}
	
	function displayKeyboard() {
		$keyboardRows = [
			['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
			['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'],
			['z', 'x', 'c', 'v', 'b', 'n', 'm']
		];
		$keyboardHTML = '<div id="qwerty" class="section"><form id="keyb" action="play.php" method="POST">';
		foreach($keyboardRows as $row) {
			$keyboardHTML .= '<div class="keyrow">';
			foreach ($row as $letter) {
				/*$keyboardHTML .= '<button type="submit" form="keyb" name="key" value=';
				$keyboardHTML .= $letter;
				$keyboardHTML .= ' class="key';
				$keyboardHTML .= $this->styleKey($letter);				
				$keyboardHTML .= '>';
				$keyboardHTML .= $letter;
				$keyboardHTML .= '</button>';*/
				$keyboardHTML .= '<button type="submit" form="keyb" name="key" value=' . $letter . ' class="key' .
								 $this->styleKey($letter) . '>' . $letter . '</button>';
			}
			$keyboardHTML .= '</div>';
		}
		$keyboardHTML .= '</form></div>';
		return $keyboardHTML;
	}
	
	function displayScore() {
		$scoreHTML = '<div id="scoreboard" class="section"><ol>';
		for ($i = 0; $i < ($this->phrase->numberLost()); $i++) {
			$scoreHTML .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
		}
		for ($i = 0; $i < ($this->lives - $this->phrase->numberLost()); $i++) {
			$scoreHTML .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
		}
		$scoreHTML .= '</ol></div>';
		return $scoreHTML;
	}
}
?>