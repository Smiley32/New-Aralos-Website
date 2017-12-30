<?php

class MonstersController extends Controller {
    protected function add() {
        $this->title = "Ajout d'un monstre";

        require_once('views/monsters/' . $this->_action . '.php');
    }
}

?>