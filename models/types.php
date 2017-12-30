<?php

class Types {
    public static function getAll() {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM types');
        $ret = $req->execute();

        return !$ret ? false : $req->fetchAll();
    }
}

?>