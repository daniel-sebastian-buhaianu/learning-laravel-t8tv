<?php

class Category {

	private $name;

	public function __construct() {

		$url = getCurrentPageUrl();
		$this->name = $this->getNameFromUrl($url);
		return;
	}

	public function render() {

		$vars = array();

		$vars['name'] = $this->prettifyName();
		$vars['data'] = $this->getData();

		include __DIR__.'/../views/category.views.php';
		return;
	}

	private function getNameFromUrl($url) {

		$name = str_replace(BASE_URL.'/category/', '', $url);
		return $name;
	}

	private function prettifyName() {

		$name = $this->name;
		$wordsInName = explode('-', $name);
		
		$result = '';
		foreach($wordsInName as $word) {
			$result .= ucfirst($word).' ';
		}

		return $result;
	}

	private function getData() {

		$name = $this->name;
		switch ($name) {
			case 'tate-confidential':
				$data = $this->getDataFromUrl('https://dsb99.app/rumble/api/v1/channel/tateconfidential/videos');
				break;
			case 'tate-speech':
				$data = $this->getDataFromUrl('https://dsb99.app/rumble/api/v1/channel/TateSpeech/videos');
				break;
			default:
				$data = null;
		}

		return $data;
	}

	private function getDataFromUrl($url) {

		$data = null;

		$response = file_get_contents($url);
		if (false !== $response) {

		    $data = json_decode($response);
		}

		return $data;
	}
	
}