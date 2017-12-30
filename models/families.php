<?php

class Families {
    public static function insert($name) {
        $db = Db::getInstance();

        $req = $db->prepare('INSERT INTO families (fa_name) VALUES (:fa_name)');
        $ret = $req->execute(array('fa_name' => $name));

        return $ret; // true / false
    }

    public static function getAll() {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM families');
        $ret = $req->execute();

        return !$ret ? false : $req->fetchAll();
    }
}

?>