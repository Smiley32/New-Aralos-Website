<?php

class Families {
    /// Retourne l'id de la famille ajoutée ou false
    public static function add($name) {
        $db = Db::getInstance();

        // Vérification de l'existence de la famille
        $family = Families::getByName($name);
        if(isset($family['fa_id'])) {
            return false;
        }

        $req = $db->prepare('INSERT INTO families (fa_name) VALUES (:fa_name)');
        $ret = $req->execute(array('fa_name' => $name));

        return !$ret ? false : $db->lastInsertId();
    }

    public static function getById($id) {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM families WHERE fa_id=:fa_id');
        $ret = $req->execute(array('fa_id' => $id));

        return !$ret ? false : $req->fetch();
    }

    public static function getByName($name) {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM families WHERE fa_name=:fa_name');
        $ret = $req->execute(array('fa_name' => $name));

        return !$ret ? false : $req->fetch();
    }
}

?>