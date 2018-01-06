<?php

class RunagesController extends Controller {
    protected function add() {
        $this->title = 'Ajouter un runage';

        $error = false;
        if(isset($_POST['submit'])) {
            $sets = array();
            require_once('models/runages.php');

            for($nb = 1; $nb <= 3; $nb++) {
                if(isset($_POST['set' . $nb])) {
                    if(strlen($_POST['set' . $nb]) > 0) {
                        // On recherche le set dans la bdd
                        $s = Runages::getSet($_POST['set' . $nb]);
                        if(isset($s['set_id'])) {
                            $sets[] = $s['set_id'];
                        } else {
                            $error = true;
                            $errors[] = 'Impossible de trouver le set n°' . $nb . 'choisi';
                        }
                    }
                }
            }

            $stats = array();
            $nbStats = 0;
            while(isset($_POST['stat' . $nbStats])) {
                $stats[] = $_POST['stat' . $nbStats];
                $nbStats++;
            }

            if($nbStats == 0) {
                $error = true;
                $errors[] = 'Il faut choisir au moins une stat à privilégier';
            }

            if(!isset($_POST['desc']) || strlen($_POST['desc']) == 0) {
                $error = true;
                $errors[] = 'Il faut entrer une description';
            }

            if(!$error) {
                // On va entrer le runage dans la bdd
                $runageId = Runages::addRunage($sets, $stats, $_POST['desc']);

                if($runageId === false) {
                    $error = true;
                    $errors[] = "Une erreur est survenue lors de l'ajout du runage";
                } else {
                    // Redirection
                    $_SESSION['message'] = 'Vous avez bien ajouté un runage';
                    $_SESSION['messageType'] = 'success';

                    redirect('runages', 'connect', 'id=' . $runageId);
                }
            }
        }

        require_once('views/runages/' . $this->_action . '.php');
    }

    /// Cette page va demander à l'utilisateur de connecter le runage à un monstre et une compo
    protected function connect() {
        $this->title = "Connecter le runage";

        $error = false;

        if(!isset($_GET['id'])) {
            $id = 1;
        } else {
            $id = $_GET['id'];
        }

        // Récupération du runage (son texte)
        require_once('models/runages.php');
        $runage = Runages::getRunage($id);

        if(!isset($runage['ru_id'])) {
            $error = true;
            $errors = "Le runage choisi n'est pas valide";
        } else {
            // Récupération des sets
            $sets = Runages::getSets($id);

            // Récupération des stats
            $stats = Runages::getStats($id);

            $importances[1] = 'Utile';
            $importances[2] = 'Important';
            $importances[3] = 'Essentiel';
        }

        if(isset($_POST['submit'])) {
            if(!isset($_GET['id'])) {
                $error = true;
                $errors[] = "Aucun runage n'a été choisi";
            } else {
                $runageId = $_GET['id'];
            }

            if(!isset($_POST['monster']) || strlen($_POST['monster']) == 0) {
                $error = true;
                $errors[] = "Aucun monstre n'a été choisi";
            } else {
                $monsterName = $_POST['monster'];
            }

            if(!isset($_POST['compo']) || strlen($_POST['compo']) == 0) {
                $error = true;
                $errors[] = "Aucune compo n'a été choisie";
            } else {
                $compoId = $_POST['compo'];
            }

            if(!isset($_POST['desc']) || strlen($_POST['desc']) == 0) {
                $error = true;
                $errors[] = "Aucune description n'a été entrée";
            } else {
                $desc = $_POST['desc'];
            }

            if(!$error) {
                // Ajout à la bdd
                require_once('models/runages.php');
                $ret = Runages::connect($runageId, $monsterName, $compoId, $desc);

                if($ret) {
                    $_SESSION['message'] = 'Le runage a bien été associé à un monstre et une comp';
                    $_SESSION['messageType'] = 'success';
                    redirect('pages', 'home');
                } else {
                    $error = true;
                    $errors[] = "Une erreur est survenue";
                }
            }

        }

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
