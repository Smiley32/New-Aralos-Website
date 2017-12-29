<?php

class PagesController extends Controller {
    function __construct($action) {
        parent::__construct($action);

        // Default title for 'pages'
        $this->title = 'Aralos';
    }

    protected function home() {
        $this->title = 'Home';
        
        require_once('views/pages/' . $this->_action . '.php');
    }

    protected function error() {
        $this->title = 'Erreur !';

        // We write the page in the buffer
        require_once('views/pages/' . $this->_action . '.php');
    }
}

?>