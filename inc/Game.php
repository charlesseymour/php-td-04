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
}
?>