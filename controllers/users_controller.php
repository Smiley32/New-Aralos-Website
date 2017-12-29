<?php

class UsersController extends Controller {
    protected function connection() {
        $this->title = "Connexion";

        require_once('views/users/' . $this->_action . '.php');
    }
}

?>