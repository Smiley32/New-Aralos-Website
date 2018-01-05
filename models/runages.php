<?php

class Runages {
    public static function searchSet($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM sets WHERE set_name LIKE :search OR set_effect LIKE :search');
        $ret = $req->execute(array('search' => $name));

        return !$ret ? false : $req->fetchAll();
    }

    public static function getSet($name) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM sets WHERE set_name=:set_name');
        $ret = $req->execute(array('set_name' => $name));

        return !$ret ? false : $req->fetch();
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

    public static function addRunage($setIds, $statIds, $desc) {
        $db = DB::getInstance();

        // Ajout du runage
        $req = $db->prepare('INSERT INTO runages (ru_txt) VALUES (:ru_txt)');
        $ret = $req->execute(array('ru_txt' => $desc));

        if($ret == false) {
            return false;
        }

        $runageId = $db->lastInsertId();

        // Ajout des sets
        foreach($setIds as $set) {
            $req = $db->prepare('INSERT INTO sets_runages (sr_runage, sr_set) VALUES (:sr_runage, :sr_set)');
            $ret = $req->execute(array('sr_runage' => $runageId,
                                        'sr_set' => $set));

            if($ret == false) {
                return false;
            }
        }

        // Ajout des stats
        foreach($statIds as $stat) {
            $req = $db->prepare('INSERT INTO stats_runages (sru_runage, sru_stat) VALUES (:sru_runage, :sru_stat)');
            $ret = $req->execute(array('sru_runage' => $runageId,
                                        'sru_stat' => $stat));

            if($ret == false) {
                return false;
            }
        }

        return $runageId;
    }
}

?>
