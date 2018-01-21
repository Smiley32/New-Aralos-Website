<?php

class MonstersController extends Controller {
    protected function ajaxGetPlace() {
        $this->type = 'plain';
        if(isset($_GET['search'])) {
            require_once('models/places.php');
            $places = Places::getLikeName($_GET['search']);
            if($places !== false) {
                require_once('views/monsters/' . $this->_action . '.php');
            }
        }
    }

    protected function createDescription() {
        if(!isset($_GET['id'])) {
            $this->title = "Erreur";
            echo "Aucun monstre choisi";
            return;
        }

        $monsterId = $_GET['id'];
        require_once('models/monsters.php');
        $monster = Monsters::getById($monsterId);
        if(!isset($monster['m_id'])) {
            $this->title = "Erreur";
            echo "Mauvais monstre choisi";
            return;
        }

        $this->title = $monster['m_name'];

        $error = false;
        $errors = array();

        if(isset($_POST['submit'])) {
            if(isset($_POST['desc']) && strlen($_POST['desc']) > 0) {
                $desc = $_POST['desc'];
            } else {
                $error = true;
                $errors[] = "Il faut entrer une description";
            }

            if(isset($_POST['categories']) && strlen($_POST['categories']) > 0) {
                $catText = $_POST['categories'];
            } else {
                $error = true;
                $errors[] = "Il faut entrer au moins une catégorie";
            }
        }

        require_once('views/monsters/' . $this->_action . '.php');
    }

    protected function description() {
        $this->title = "Monstre...";

        require_once('views/monsters/' . $this->_action . '.php');
    }

    protected function ajaxlist() {
        $this->type = 'plain';

        $page = 1;
        if(isset($_GET['page'])) {
            if(is_numeric($_GET['page']) && $_GET['page'] > 0) {
                $page = $_GET['page'];
            }
        }

        $search = '%';
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
        }

        // Récupération des familles
        require_once('models/families.php');
        $families = Families::searchByNameAndMonster($search, $page);

        if($families == false) {
            return;
        }

        $monsters = array();

        require_once('models/monsters.php');
        foreach($families as $f) {
            $monsters[$f['fa_id']] = Monsters::getByFamily($f['fa_id']);
        }

        require_once('views/monsters/' . $this->_action . '.php');
    }

    protected function list() {
        $this->title = 'Liste des monstres';

        $page = 1;
        if(isset($_GET['page'])) {
            if(is_numeric($_GET['page']) && $_GET['page'] > 0) {
                $page = $_GET['page'];
            }
        }

        require_once('views/monsters/' . $this->_action . '.php');
    }

    protected function ajax() {
        $this->type = 'plain';
        if(isset($_GET['search'])) {
            require_once('models/families.php');
            $families = Families::getLikeName($_GET['search']);
            if($families !== false) {
                require_once('views/monsters/' . $this->_action . '.php');
            }
        }
    }

    protected function add() {
        $this->title = "Ajout d'un monstre";

        $error = false;
        $post = false;
        $succes = false;
        if(isset($_POST['submit'])) {
            $post = true;
            // Le formulaire a été soumis, on va vérifier les informations

            // Erreurs
            $errors = array();

            if(!is_numeric($_POST['stars']) || $_POST['stars'] < 1 || $_POST['stars'] > 5) {
                $error = true;
                $errors[] = "Le nombre d'étoiles est incorrect";
            }

            if(strlen($_POST['name']) > 30) {
                $error = true;
                $errors[] = "Le nom ne doit pas dépasser 30 caractères";
            }

            if(strlen($_POST['englishName']) > 30) {
                $error = true;
                $errors[] = "Le nom anglais ne doit pas dépasser 30 caractères";
            }

            if(strlen($_POST['shortDesc']) > 500) {
                $error = true;
                $errors[] = "La description ne doit pas dépasser 500 caractères";
            }

            if(!is_numeric($_POST['type']) || $_POST['type'] < 1 || $_POST['type'] > 5) {
                $error = true;
                $errors[] = "Une valeur incorrecte de type a été choisie";
            }

            if(!isset($_FILES['file']['name']) || strlen($_FILES['file']['name']) == 0) {
                $error = true;
                $errors[] = "Vous devez choisir un icone";
            }

            if(!$error) {
                // Gestion de l'upload
                $targetDir = 'uploads/';
                $targetFile = $targetDir . basename($_FILES['file']['name']);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES['file']['tmp_name']);
                if($check !== false) {
                    if($imageFileType != 'png') {
                        $error = true;
                        $errors[] = "Le fichier n'est pas un png";
                    } else {
                        list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
                        if($width != 102 || $height != 102) {
                            $error = true;
                            $errors[] = "L'image doit être de taille 102x102px";
                        } else {
                            // Enfin, on suppose que l'image est correcte

                            // Vérifions donc les familles
                            if(strlen($_POST['familyName']) > 30) {
                                $error = true;
                                $errors[] = "Le nom de la famille est trop long";
                            } else {
                                require_once('models/families.php');

                                // On regarde si la famille existe
                                $fam = Families::getByName($_POST['familyName']);

                                if(isset($fam['fa_stars']) && $fam['fa_stars'] % 10 == 0) {
                                    $oldStars = $fam['fa_stars'];
                                    $newStars = $_POST['stars'] * 10;

                                    if($oldStars > $newStars) {
                                        $newStars += 5;
                                    } elseif($newStars > $oldStars) {
                                        $newStars = $oldStars + 5;
                                    }

                                    if(!Families::updateStars($fam['fa_id'], $newStars / 10.0)) {
                                        $error = true;
                                        $errors[] = "La famille n'a pas été mise à jour correctement";
                                    }
                                }

                                $familyId = isset($fam['fa_id']) ? $fam['fa_id'] : Families::add($_POST['familyName'], $_POST['stars']);
                            }

                            if($familyId == false) {
                                $error = true;
                                $errors[] = "Impossible de créer la famille";
                            }

                            if(!move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                                $error = true;
                                $errors[] = "Le fichier n'a pas été uploadé correctement";
                            }

                            if(!$error) {
                                require_once('models/monsters.php');

                                if(isset($_POST['englishName']) && strlen($_POST['englishName']) > 0) {
                                    $englishName = $_POST['englishName'];
                                } else {
                                    $englishName = NULL;
                                }

                                $ret = Monsters::add($_POST['name'], $_POST['stars'], $_POST['shortDesc'], $targetFile, $familyId, $_POST['type'], $englishName);

                                if($ret == false) {
                                    $error = true;
                                    $errors[] = "L'ajout du monstre a échoué";
                                } else {
                                    $succes = true;
                                    $post = false;
                                }
                            }
                        }
                    }
                } else {
                    $error = true;
                    $errors[] = "Le fichier n'est pas une image";
                }
            }
        }

        require_once('views/monsters/' . $this->_action . '.php');
    }
}

?>
