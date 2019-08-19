<?php
class Game 
{
	private $phrase;
	private $lives = 5;
	
	function __construct($Phrase) {
		$this->phrase = $Phrase;
	}
	
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
			return '<h1 id="overlay" class="lose">The phrase was: "' . $this->phrase->getPhrase() . 
			'". Better luck next time!
			<form class="restart" action="play.php" method="post">
                <input id="btn__reset" type="submit" name="start" value="Start Game" />
            </form>
			</h1>';
		} else if ($this->checkForWin()) {
			return '<h1 id="overlay" class="win">Congratulations on guessing: "' . $this->phrase->getPhrase() . 
			'"!
			<form class="restart" action="play.php" method="post">
                <input id="btn__reset" type="submit" name="start" value="Start Game" />
            </form>
			</h1>';
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