<?php

class App {

    private $controllerClassName;
    private $controllerFileName;
    private $requestPath;

	public function __construct() {

        $url = getCurrentPageUrl();
        $requestPath = getUrlPath($url);
        switch ($requestPath) {
            case ROOT_PATH:
            case ROOT_PATH.'/':
                $this->controllerClassName = 'Home';
                $this->controllerFileName = 'home.controller.php';
                break;

            case ROOT_PATH.'/categories':
                $this->controllerClassName = 'Categories';
                $this->controllerFileName = 'categories.controller.php';
                break;

            case 0 === strpos( $requestPath, ROOT_PATH.'/category' ):
                $this->controllerClassName = 'Category';
                $this->controllerFileName = 'category.controller.php';
                break;
                
            default:
                $this->controllerClassName = 'PageNotFound';
                $this->controllerFileName = 'page-not-found.controller.php';
                break;
        }

        $this->requestPath = $requestPath;
        return;
	}

    public function loadController() {

        $controller = new $this->controllerClassName;
        $controller->render();
        return;
    }

    public function get($property) {

        switch ($property) {
            case 'controllerClassName':
                return $this->controllerClassName;
            case 'controllerFileName':
                return $this->controllerFileName;
            case 'requestPath':
                return $this->requestPath;
            default:
                return null;
        }
    }
}