<?php

class UsersController extends Controller {
    protected function connection() {
        $this->title = "Connexion";

        require_once('views/users/' . $this->_action . '.php');
    }

    protected function inscription() {
        $this->title = "inscription";

        $error = false;
        $isInGuild = false;
        $succes = false;
        $post = false;

        if(isset($_POST['submit'])) {
            $post = true;

            // Vérifications
            $errors = array();

            $pseudo = $_POST['pseudo'];
            if(strlen($pseudo) > 30) {
                $error = true;
                $errors[] = "Le pseudo est trop long";
            }
            if(strlen($pseudo) == 0) {
                $error = true;
                $errors[] = "Le pseudo est vide";
            }

            $pass = $_POST['pass'];
            $passAgain = $_POST['passAgain'];

            if(strlen($pass) < 4) {
                $error = true;
                $errors[] = "Le mot de passe est trop court";
            }
            if($pass != $passAgain) {
                $error = true;
                $errors[] = "Les mots de passes ne correspondent pas";
            }

            $mail = $_POST['mail'];
            if(strlen($mail) == 0 || strlen($mail) > 255) {
                $mail = NULL;
            }

            if(isset($_POST['guildKey']) && strlen($_POST['guildKey']) == 0) {
                if(!is_numeric($_POST['guildId'])) {
                    $error = true;
                    $errors[] = "Guilde incorrecte";
                } else {
                    // On récupère la guilde sélectionnée et on vérifie le mot de passe
                    require_once('models/guild.php');
                    $guild = Guild::getById($_POST['guildId']);

                    if($guild === false) {
                        $error = true;
                        $errors[] = "Guilde introuvable";
                    } else {
                        if($_POST['guildKey'] != $guild['g_mdp']) {
                            $error = true;
                            $errors[] = "La clé d'inscription est incorrecte";
                        } else {
                            $isInGuild = $guild['g_id'];
                        }
                    }
                }
            }

            if(!$error) {
                // On peut essayer d'inscrire l'utilisateur
                require_once('models/users.php');
                $userId = Users::add($pseudo, $pass, $mail);

                if(!$userId) {
                    $error = true;
                    $errors[] = "Impossible de créer l'utilisateur";
                } else {
                    $succes = true;
                    $post = false;
                    if($isInGuild !== false) {
                        // Ajout de l'utilisateur à user_guild
                        require_once('models/guild.php');
                        if(!Guild::addUser($userId, $isInGuild)) {
                            $error = true;
                            $errors[] = "Ajout à la guilde impossible";
                        }
                    }
                }
            }
        }

        require_once('views/users/' . $this->_action . '.php');
    }
}

?>