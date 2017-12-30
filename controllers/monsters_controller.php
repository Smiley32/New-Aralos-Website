<?php

class MonstersController extends Controller {
    protected function add() {
        $this->title = "Ajout d'un monstre";

        $error = false;
        if(isset($_POST['submit'])) {
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

            $allTypes = array('Vent', 'Feu', 'Eau', 'Lumière', 'Ténèbre');

            if(!array_key_exists($_POST['type'], $allTypes)) {
                $error = true;
                $errors[] = "Une valeur incorrecte de type a été choisie";
            }

            if($_POST['family'] == 'nothing') {
                $error = true;
                $errors[] = "Vous devez choisir une famille ou bien en créer une";
            } elseif($_POST['family'] != 'ajout' && !is_numeric($_POST['family'])) {
                $error = true;
                $errors[] = "Une valeur incorrecte de famille a été choisie";
            }

            if(!isset($_FILES['file']['name'])) {
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
                            if($_POST['family'] != 'ajout') {
                                $familyId = $_POST['family'];
                            } else {
                                // On veut ajouter une famille
                                require_once('models/families.php');
                                if(strlen($_POST['familyName']) > 30) {
                                    $error = true;
                                    $errors[] = "Le nom de la famille est trop long";
                                } else {
                                    $familyId = Families::add($_POST['familyName']);
                                }
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