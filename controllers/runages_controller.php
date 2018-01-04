<?php

class RunagesController extends Controller {
    protected function add() {
        $this->title = 'Ajouter un runage';

        require_once('views/runages/' . $this->_action . '.php');
    }

    protected function ajaxGetSet() {
        $this->type = 'plain';

        if($_GET['search']) {
            // Recherche dans la base de données
            require_once('models/runages.php');
            $sets = Runages::searchSet($_GET['search']);

            if($sets != false) {
                require_once('views/runages/' . $this->_action . '.php');
            }
        }
    }

    protected function ajaxSearchStat() {
        $this->type = 'plain';

        if($_GET['search']) {
            // Recherche dans la base de données
            require_once('models/runages.php');
            $stats = Runages::searchStat($_GET['search']);

            if($stats != false) {
                require_once('views/runages/' . $this->_action . '.php');
            }
        }
    }

    protected function ajaxAddStat() {
        $this->type = 'plain';

        if(!isset($_GET['nb'])) {
            return;
        }

        if(isset($_GET['name'], $_GET['importance'])) {
            if(!is_numeric($_GET['importance']) || $_GET['importance'] < 1 || $_GET['importance'] > 3) {
                return;
            }
            $importance = $_GET['importance'];

            // Récupération de l'id de la stat
            require_once('models/runages.php');
            $stat = Runages::getSmallStat($_GET['name']);
            if($stat == false) {
                $statId = Runages::addSmallStat($_GET['name']);

                if($statId == false) {
                    return;
                }
                $stat['sl_id'] = $statId;
                $stat['sl_name'] = $_GET['name'];
            }

            $value = NULL;
            if(isset($_GET['value']) && $_GET['value'] != false && strlen($_GET['value']) != 0) {
                $value = $_GET['value'];
            }


            $statID = Runages::addStat($stat['sl_id'], $importance, $value);

            $importances[1] = 'Utile';
            $importances[2] = 'Important';
            $importances[3] = 'Essentiel';

            if($statID !== false) {
                require_once('views/runages/' . $this->_action . '.php');
            }
        }
    }
}

?>
