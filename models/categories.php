<?php

class Categories {
    /// Ajoute une catégorie, et retourne son id
    public static function add($label) {
        $db = Db::getInstance();

        // On vérifie l'existence de la catégorie
        $cat = Categories::getByName($label);
        if(isset($cat['cat_id'])) {
            return $cat['cat_id'];
        }

        $req = $db->prepare('INSERT INTO categories (cat_label) VALUES (:cat_label)');
        $ret = $req->execute(array('cat_label' => $label));

        return !$ret ? false : $db->lastInsertId();
    }

    public static function getByName($name) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM categories WHERE cat_label=:cat_label');
        $ret = $req->execute(array('cat_label' => $name));

        return !$ret ? false : $req->fetch();
    }

    public static function getLikeName($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM categories WHERE cat_label LIKE :cat_label');
        $ret = $req->execute(array('cat_label' => $name));

        return !$ret ? false : $req->fetchAll();
    }
}

?>
