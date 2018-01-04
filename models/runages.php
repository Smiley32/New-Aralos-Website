<?php

class Runages {
    public static function searchSet($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM sets WHERE set_name LIKE :search OR set_effect LIKE :search');
        $ret = $req->execute(array('search' => $name));

        return !$ret ? false : $req->fetchAll();
    }

    public static function searchStat($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM stats_list WHERE sl_name LIKE :search');
        $ret = $req->execute(array('search' => $name));

        return !$ret ? false : $req->fetchAll();
    }

    public static function addSmallStat($name) {
        $db = Db::getInstance();

        $req = $db->prepare('INSERT INTO stats_list (sl_name) VALUES (:sl_name)');
        $ret = $req->execute(array('sl_name' => $name));

        return !$ret ? false : $db->lastInsertId();
    }

    public static function getSmallStat($name) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM stats_list WHERE sl_name=:sl_name');
        $ret = $req->execute(array('sl_name' => $name));

        return !$ret ? false : $req->fetch();
    }

    public static function getStat($smallStatId, $importance, $value) {
        $db = Db::getInstance();

        if($value != NULL) {
            $req = $db->prepare('SELECT * FROM stats WHERE stat_name=:stat_name AND stat_importance=:stat_importance AND stat_value=:stat_value');
            $ret = $req->execute(array('stat_name' => $smallStatId,
                                        'stat_importance' => $importance,
                                        'stat_value' => $value));
        } else {
            $req = $db->prepare('SELECT * FROM stats WHERE stat_name=:stat_name AND stat_importance=:stat_importance');
            $ret = $req->execute(array('stat_name' => $smallStatId,
                                        'stat_importance' => $importance));
        }


        return !$ret ? false : $req->fetch();
    }

    public static function addStat($smallStatId, $importance, $value) {
        $db = Db::getInstance();

        // Vérification de l'existence de cette stat (dans ce cas on retourne son id)
        $stat = Runages::getStat($smallStatId, $importance, $value);
        if(isset($stat['stat_id'])) {
            return $stat['stat_id'];
        }

        // Ajout de la stat
        $req = $db->prepare('INSERT INTO stats (stat_name, stat_importance, stat_value) VALUES (:stat_name, :stat_importance, :stat_value)');
        $ret = $req->execute(array('stat_name' => $smallStatId,
                                    'stat_importance' => $importance,
                                    'stat_value' => $value));

        return !$ret ? false : $db->lastInsertId();
    }
}

?>
