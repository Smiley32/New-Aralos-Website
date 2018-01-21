<?php

class Places {
    public static function getLikeName($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM places WHERE p_name LIKE :p_name');
        $ret = $req->execute(array('p_name' => $name));

        return !$ret ? false : $req->fetchAll();
    }

    public static function getByName($name) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM places WHERE p_name=:p_name');
        $ret = $req->execute(array('p_name' => $name));

        return !$ret ? false : $req->fetch();
    }

    public static function addToMonster($monsterId, $placeName) {
        $sb = Db::getInstance();

        // Vérification de l'existence du monstre
        require_once('models/monsters.php');
        $monster = Monsters::getById($monsterId);
        if(!isset($monster['m_id'])) {
            return false;
        }

        // Vérification de l'existence du lieu
        $place = Places::getByName($placeName);
        if(!isset($place['p_id'])) {
            return false;
        }

        $req = $db->prepare('INSERT INTO monsters_places (mp_monster, mp_place) VALUES (:mp_monster, :mp_place)');
        $ret = $req->execute(array('mp_monster' => $monster['m_id'],
                                'mp_place' => $place['p_id']));

        return $ret;
    }
}

?>
