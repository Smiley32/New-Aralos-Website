<?php

class Route {
    private $_controller;
    private $_action;

    private $_controllers = array('pages' => ['home', 'error']);

    private $_page;

    function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
        
        if(!array_key_exists($controller, $this->_controllers) || !in_array($action, $this->_controllers[$controller])) {
            $this->_controller = 'pages';
            $this->_action = 'error';
        }
    }

    public function call() {
        // Associated file
        require_once('controllers/Controller.php');
        require_once('controllers/' . $this->_controller . '_controller.php');
    
        switch($this->_controller) {
            case 'pages':
                $this->_page = new PagesController($this->_action);
                break;
        }
    
        // Call the function corresponding to the action

        ob_end_clean(); // Should be useless
        // We don't want to write right now
        ob_start();
        $this->_page->call();
        // $this->_page->{ $this->_action }();
    }

    public function display() {
        $title = $this->_page->title;
        $body = $this->_page->body;

        require_once('views/layout.php');
    }
}

?>