<?php

class UsersController extends Controller {
    protected function edit() {
        $this->title = 'Modifier mes infos';

        require_once('views/users/' . $this->_action . '.php');
    }

    protected function profil() {
        $this->title = 'Mon profil';

        require_once('views/users/' . $this->_action . '.php');
    }

    protected function deconnection() {
        if(!isConnected()) {
            $_SESSION['message'] = 'Vous n\'êtes pas connecté';
            $_SESSION['messageType'] = 'error';

            redirect('pages', 'home');
        }

        unset($_SESSION['id']);
        unset($_SESSION['pseudo']);
        unset($_SESSION['mail']);
        unset($_SESSION['guild']);

        $_SESSION['message'] = 'Vous vous êtes correctement déconnecté';
        $_SESSION['messageType'] = 'success';

        redirect('pages', 'home');
    }

    protected function connection() {
        if(isConnected()) {
            // Redirection vers l'accueil
            $_SESSION['message'] = 'Vous êtes déjà connecté';
            $_SESSION['messageType'] = 'error';

            redirect('pages', 'home');
        }

        $this->title = "Connexion";

        $error = false;

        if(isset($_POST['coSubmit'])) {
            if(strlen($_POST['pseudo']) > 30) {
                $error = true;
                $errors[] = "Le pseudo est trop long";
            }

            if(strlen($_POST['pseudo']) == 0) {
                $error = true;
                $errors[] = "Il faut entrer un pseudo";
            }

            if(strlen($_POST['pass']) == 0) {
                $error = true;
                $errors[] = "Il faut entrer un mot de passe";
            }

            if(!$error) {
                // On va chercher l'utilisateur dans la bdd
                require_once('models/users.php');

                $user = Users::getByName($_POST['pseudo']);
                if($user == false) {
                    $error = true;
                    $errors[] = "Impossible de trouver l'utilisateur";
                } else {
                    // Vérification du mot de passe
                    if(password_verify($_POST['pass'], $user['u_hash'])) {
                        $_SESSION['id'] = $user['u_id'];
                        $_SESSION['pseudo'] = $user['u_pseudo'];
                        $_SESSION['mail'] = $user['u_mail'];

                        // On regarde si il est dans une guilde
                        require_once('models/guild.php');
                        $guild = Guild::getByUser($user['u_id']);
                        if(isset($guild['g_name'])) {
                            $_SESSION['guild'] = $guild['g_name'];
                        } else {
                            $_SESSION['guild'] = false;
                        }

                        // Redirection vers l'accueil
                        $_SESSION['message'] = 'Vous êtes maintenant connecté !';
                        $_SESSION['messageType'] = 'success';

                        redirect('pages', 'home');
                    } else {
                        $error = true;
                        $errors[] = "Le mot de passe est incorrect";
                    }
                }
            }
        }

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

            if(isset($_POST['guildKey']) && strlen($_POST['guildKey']) > 0) {
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

        if($succes) {
            // On redirige vers la page de connection
            $_SESSION['message'] = 'Vous êtes désormais inscrits, vous pouvez dès à présent vous connecter';
            $_SESSION['messageType'] = 'success';

            redirect('pages', 'home');
        }

        require_once('views/users/' . $this->_action . '.php');
    }
}

?>
