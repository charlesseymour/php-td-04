<?php
class Game 
{
	private $phrase;
	private $lives;
	
	function __construct($Phrase) {
		$this->$phrase = $Phrase;
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
		]
		$keyboardHTML = '<div id="qwerty" class="section">';
		foreach($keyboardRows as $row) {
			$keyboardHTML .= '<div class="keyrow">';
			foreach ($row as $letter) {
				$keyboardHTML .= '<button class="key';
				if ($this->phrase->checkLetter($letter)) {
					$keyboardHTML .= 'correct';
				else {
					$keyboardHTML .= 'incorrect';
				}
				$keyboardHTML .= '"';
				if in_array($letter, $this->phrase->getSelected()) {
					$keyboardHTML .= 'style="background-color: red" disabled>';
				}
				$keyboardHTML .= $letter;
				$keyboardHTML .= '</button>';
			}
			$keyboardHTML .= '</div>';
		}
		$keyboardHTML .= '</div>';
	}
}
?>