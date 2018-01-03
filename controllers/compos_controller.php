<?php

class ComposController extends Controller {
    protected function add() {
        $this->title = "Ajout d'une compo";

        $error = false;
        $success = false;
        if(isset($_POST['submit'])) {
            // Vérifications
            if(!isset($_POST['monsters']) || strlen($_POST['monsters']) == 0) {
                $error = true;
                $errors[] = 'Il faut sélectionner des monstres';
            } else {
                $monsters = $_POST['monsters'];
            }

            if(!isset($_POST['categorieName']) || strlen($_POST['categorieName']) == 0) {
                $error = true;
                $errors[] = 'Il faut sélectionner une catégorie';
            } elseif(strlen($_POST['categorieName']) > 30) {
                $error = true;
                $errors[] = 'Le nom de la catégorie est trop long';
            } else {
                $categorie = $_POST['categorieName'];
            }

            if(isset($_POST['shortDesc']) && strlen($_POST['shortDesc']) > 500) {
                $error = true;
                $errors[] = 'La description est trop longue';
            } else {
                $shortDesc = $_POST['shortDesc'];
            }

            if(!$error) {
                // On va à présent vérifier les monstres selectionnés
                $monsters = substr($monsters, 1); // Suppression du ';' de début de chaine
                $monstersArray = explode(';', $monsters);

                $nb = count($monstersArray);
                if($nb < 3 || $nb > 5) {
                    $error = true;
                    $errors[] = 'Vous avez entré un nombre incorrect de monstres';
                }

                require_once('models/monsters.php');
                foreach($monstersArray as $monster) {
                    // Vérification que le monstre existe
                    $m = Monsters::getByName($monster);
                    if($m == false || !isset($m['m_id'])) {
                        $error = true;
                        $errors[] = 'Le monstre ' . $monster . ' est introuvable';
                    }
                }

                if(!$error) {
                    // Ajout de la compo à la bdd
                    require_once('models/compos.php');
                    if(!Compos::add($monstersArray, $categorie, $shortDesc)) {
                        $error = true;
                        $errors[] = 'Impossible de créer correctement la compo';
                    } else {
                        $success = true;
                    }
                }
            }
        }

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

    protected function ajaxGetCategorie() {
        $this->type = 'plain';
        if(isset($_GET['name'])) {
            require_once('models/categorie.php');
            $categories = Categorie::getLikeName($_GET['name']);
            if($categories !== false) {
                require_once('views/compos/' . $this->_action . '.php');
            }
        }
    }
}

?>
