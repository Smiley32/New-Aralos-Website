<?php

class Types {
    public static function getAll() {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM types');
        $ret = $req->execute();

        return !$ret ? false : $req->fetchAll();
    }

    public static function getById($id) {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM types WHERE t_id=:t_id');
        $ret = $req->execute(array('t_id' => $id));

        return !$ret ? false : $req->fetch();
    }
}

?>