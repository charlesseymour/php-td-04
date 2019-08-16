<?php
class Game 
{
	private $phrase;
	private $lives = 5;
	
	function __construct($Phrase) {
		$this->phrase = $Phrase;
	}
	
	function checkForWin() {
		$phraseLetters = array_unique(str_split(str_replace(' ', '',strtolower($this->$phrase->getPhrase()))));
		foreach ($phraseLetters as $phraseLetter) {
			if (!in_array($phraseLetter, $this->phrase->getSelected())) {
				return false;
			}
		}
		return true;
	}
	
	function checkForLose() {
		return count($this->phrase->getSelected()) >= count($this->lives);
	}
	
	function gameOver() {
		if (checkForWin()) {
			echo "Congratulations, you won!";
		} elseif (checkForLose()) {
			echo "Sorry, you lost.";
		} else {
			return false;
		}
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
				$keyboardHTML .= '<button type="submit" name="key" value=';
				$keyboardHTML .= $letter;
				$keyboardHTML .= ' class="key';
				if ($this->phrase->checkLetter($letter)) {
					$keyboardHTML .= ' correct';
				} else {
					$keyboardHTML .= ' incorrect';
				}
				$keyboardHTML .= '"';
				if (in_array($letter, $this->phrase->getSelected())) {
					$keyboardHTML .= 'style="background-color: red" disabled';
				}
				$keyboardHTML .= '>';
				$keyboardHTML .= $letter;
				$keyboardHTML .= '</button>';
			}
			$keyboardHTML .= '</div>';
		}
		$keyboardHTML .= '</form></div>';
		return $keyboardHTML;
	}
	
	function displayScore() {
		$scoreHTML = '<div id="scoreboard" class="section"><ol>';
		for ($i = 0; $i < (5 - $this->lives); $i++) {
			$scoreHTML .= '<li class="tries"><img src="images/loseHeart.png" height="35px" widght="30px"></li>';
		}
		for ($i = 0; $i < $this->lives; $i++) {
			$scoreHTML .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
		}
		$scoreHTML .= '</ol></div>';
		return $scoreHTML;
	}
}
?>