<?php

class ComposController extends Controller {
    protected function add() {
        $this->title = "Ajout d'une compo";

        require_once('views/compos/' . $this->_action . '.php');
    }

    protected function ajaxGetMonster() {
        $this->type = 'plain';
        if(isset($_GET['search'])) {
            require_once('models/monsters.php');
            $monsters = Monsters::getLikeName($_GET['search']);
            if($monsters !== false) {
                require_once('views/compos/' . $this->_action . '.php');
            }
        }
    }

    protected function ajaxAddMonster() {
        $this->type = 'plain';
        if(isset($_GET['name'])) {
            require_once('models/monsters.php');
            $monster = Monsters::getByName($_GET['name']);
            if($monster !== false) {
                require_once('views/compos/' . $this->_action . '.php');
            }
        }
    }
}

?>
