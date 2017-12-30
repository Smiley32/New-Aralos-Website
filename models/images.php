<?php

class Images {
    public static function get($id) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM families WHERE img_id=:img_id');
        $ret = $req->execute(array('img_id' => $id));

        return !$ret ? false : $req->fetch();
    }

    /// Retourne l'id de l'image ajoutée ou false
    public static function add($path) {
        $db = Db::getInstance();

        // Hachage (md5) du nom de l'image
        // Ajout de ce hash à la base de données
        $hash = hash_file("md5", $path);
        rename($path, 'images/bdd/' . $hash);

        $req = $db->prepare('INSERT INTO images(img_name) VALUES (:img_name)');
        $ret = $req->execute(array('img_name' => $hash));

        if(!$ret) {
            // On n'a pas pu ajouter l'image à la bdd, donc on la supprime du répertoire
            unlink('images/bdd/' . $hash);
        }

        return !$ret ? false : $db->lastInsertId();
    }
}

?>