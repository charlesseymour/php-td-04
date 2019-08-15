class Phrase 
{
	private $currentPhrase;
	private $selected = [];
	
	function __construct($phrase = null, $selected = null) {
		$this->currentPhrase = $phrase;
		$this->selected = $selected;
	}
	
	function addPhraseToDisplay() {
		$phraseHTML = "<div id="phrase" class="section"><ul>";
		$letters = str_split(strtolower($this->currentPhrase));
		foreach($letters as $letter) {
			if ($letter) {
				$phraseHTML .= '<li class="hide letter h">' . $letter . '</li>';
			} else {
				$phraseHTML .= '<li class="hide space"> </li>';
			}
		}
		$phraseHTML .= '</ul></div>';
		return $phraseHTML;
	}
	
	function checkLetter($letter) {
		$letters = array_unique(str_split(str_replace(' ', '',strtolower($this->currentPhrase))));
		return in_array($letter, $letters);
	}
	
	
}

