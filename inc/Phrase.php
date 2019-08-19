<?php 
class Phrase 
{
	private $currentPhrase = "dream big";
	private $selected = [];
	public $phrases = [
			'Boldness be my friend',
			'Leave no stone unturned',
			'Broken crayons still color',
			'The adventure begins',
			'Dream without fear',
			'Love without limits'
	];
	
	function __construct($phrase = null, $selected = null) {
		if (!empty($phrase)) {
			$this->currentPhrase = $phrase;
		} else {
			$this->currentPhrase = $this->phrases[rand(0, count($this->phrases) - 1)];
		}
		if (!empty($selected)) {
			$this->selected = $selected;
		}
	}
	
	function addPhraseToDisplay() {
		$phraseHTML = '<div id="phrase" class="section"><ul>';
		$letters = str_split(strtolower($this->currentPhrase));
		foreach($letters as $letter) {
			if ($letter !== " ") {
				if (in_array($letter, $this->selected)) {
					$phraseHTML .= '<li class="show letter ' . $letter . '">' . $letter . '</li>';
				} else {
					$phraseHTML .= '<li class="hide letter ' . $letter . '">' . $letter . '</li>';
				}
			} else {
				$phraseHTML .= '<li class="hide space"> </li>';
			}
		}
		$phraseHTML .= '</ul></div>';
		return $phraseHTML;
	}
	
	function getLetterArray() {
		return array_unique(str_split(str_replace(' ', '',strtolower($this->currentPhrase))));
	}
	
	function checkLetter($letter) {
		return $this->getLetterArray();
	}
	
	function numberLost() {
		return count(array_diff($this->selected, $this->getLetterArray()));
	}
	
	function getPhrase() {
		return $this->currentPhrase;
	}
	
	function getSelected () {
		return $this->selected;
	}	
}
?>
