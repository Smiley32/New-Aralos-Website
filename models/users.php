<?php

class Users {
    public static function add($pseudo, $password, $mail = NULL, $bestMonster = NULL) {
        $db = Db::getInstance();
        // Vérification de l'existence de cet utilisateur

        $req = $db->prepare('SELECT u_pseudo FROM users WHERE u_pseudo=:u_pseudo');
        $req->execute(array('u_pseudo' => $pseudo));

        if($req->rowCount() != 0) {
            // L'utilisateur existe déjà
            return false;
        }

        // Si le monstre est choisi, on vérifie qu'il existe
        if($bestMonster != NULL) {
            // Monsters::isIn($bestMonster);
        }

        // Hachage du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $req = $db->prepare('INSERT INTO users (u_pseudo, u_hash, u_bestMonster, u_mail) VALUES (:u_pseudo, :u_hash, :u_bestMonster, :u_mail)');
        $ret = $req->execute(array('u_pseudo' => $pseudo,
                                    'u_hash' => $hash,
                                    'u_bestMonster' => $bestMonster,
                                    'u_mail' => $mail));
        
        return $ret;
    }
}

?>