<?php

class App {

    private $controllerClassName;
    private $controllerFileName;

	public function __construct() {

		$requestPath = $_GET['path'] ?? '';
        
        switch ($requestPath) {
            case '':
            case '/':
                $this->controllerClassName = 'Home';
                $this->controllerFileName = 'home.controller.php';
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
}