<?php

class Route {
    private $_controller;
    private $_action;

    private $_controllers = array('pages' => ['home', 'error'],
                                  'users' => ['connection', 'inscription', 'deconnection', 'edit', 'profil'],
                                  'monsters' => ['add', 'ajax', 'list', 'ajaxlist', 'description', 'createDescription', 'ajaxGetPlace'],
                                  'compos' => ['add', 'ajaxGetMonster', 'ajaxAddMonster', 'ajaxGetCategorie', 'ajaxSearchCompos'],
                                  'runages' => ['add', 'ajaxGetSet', 'ajaxSearchStat', 'ajaxAddStat', 'connect']);

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
            case 'users':
                $this->_page = new UsersController($this->_action);
                break;
            case 'monsters':
                $this->_page = new MonstersController($this->_action);
                break;
            case 'compos':
                $this->_page = new ComposController($this->_action);
                break;
            case 'runages':
                $this->_page = new RunagesController($this->_action);
                break;
            default:
                require_once('controllers/pages_controller.php');
                $this->_page = new PagesController('error');
                break;
        }

        // Call the function corresponding to the action
        $this->_page->call();
    }

    public function getBody() {
        return $this->_page->body;
    }

    public function display() {
        if($this->_page->type == 'html') {
            $title = $this->_page->title;
            $body = $this->_page->body;

            // On récupère le menu
            if(!isConnected()) {
                $r = new Route('users', 'connection');
                $r->call();
                $coMenu = $r->getBody();
            } else {
                $page = '';
                if($this->_controller == 'users') {
                    $page = $this->_action;
                }
            }

            require_once('views/layout.php');
        } else {
            header("Content-Type: text/plain");

            echo $this->_page->body;
        }
    }
}

?>
