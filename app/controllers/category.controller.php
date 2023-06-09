<?php

class Category {

	private $name;

	public function __construct() {

		$url = getCurrentPageUrl();
		$this->name = $this->getNameFromUrl($url);
		return;
	}

	public function render() {

		$categoryName = $this->prettifyName();
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
	
}