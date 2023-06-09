<?php

class App {

    private $controllerClassName;
    private $controllerFileName;
    private $requestPath;

	public function __construct() {

		$requestPath = $_GET['path'] ?? '';
        $this->requestPath = $requestPath;

        switch ($requestPath) {
            case '':
            case '/':
                $this->controllerClassName = 'Home';
                $this->controllerFileName = 'home.controller.php';
                break;

            case 'categories':
                $this->controllerClassName = 'Categories';
                $this->controllerFileName = 'categories.controller.php';
                break;
                
            default:
                $this->controllerClassName = 'PageNotFound';
                $this->controllerFileName = 'page-not-found.controller.php';
                break;
        }

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