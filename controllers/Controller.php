<?php

class Controller {
    protected $_action;

    public $title = 'Default Title';
    public $type = 'html';

    public $body = 'empty...';

    function __construct($action) {
        $this->_action = $action;
    }

    public function call() {
        ob_end_clean(); // Should be useless
        // We don't want to write right now
        ob_start();

        $this->{ $this->_action }();

        // We save the buffer
        $this->body = ob_get_contents();
        // We can clean the buffer
        ob_end_clean();
    }
}

?>