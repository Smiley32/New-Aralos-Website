<?php

class Families {
    /// Retourne l'id de la famille ajoutée ou false
    public static function add($name, $stars) {
        $db = Db::getInstance();

        // Vérification de l'existence de la famille
        $family = Families::getByName($name);
        if(isset($family['fa_id'])) {
            return false;
        }

        $stars = 10 * $stars;

        $req = $db->prepare('INSERT INTO families (fa_name, fa_stars) VALUES (:fa_name, :fa_stars)');
        $ret = $req->execute(array('fa_name' => $name,
                                    'fa_stars' => $stars));

        return !$ret ? false : $db->lastInsertId();
    }

    public static function updateStars($id, $newStars) {
        $db = Db::getInstance();

        $newStars = 10 * $newStars;

        $req = $db->prepare('UPDATE families SET fa_stars=:fa_stars WHERE fa_id=:fa_id');
        $ret = $req->execute(array('fa_id' => $id,
                                    'fa_stars' => $newStars));

        return $ret;
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

    public static function getLikeName($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM families WHERE fa_name LIKE :fa_name');
        $ret = $req->execute(array('fa_name' => $name));

        return !$ret ? false : $req->fetchAll();
    }

    /// Recherche les familles via leur noms ou bien les monstres qui sont dedans. $page est le numéro de page à récupérer
    public static function searchByNameAndMonster($search, $page) {
        $db = Db::getInstance();

        $page -= 1;
        $nbMaxResults = 10;
        $min = $page * $nbMaxResults;

        $search = "%$search%";

        $req = $db->prepare('SELECT DISTINCT fa_id, fa_name, fa_stars FROM families, monsters WHERE fa_id=m_family AND (fa_name LIKE :search OR m_name LIKE :search) LIMIT ' . $min . ',' . $nbMaxResults);
        $ret = $req->execute(array('search' => $search));

        return !$ret ? false : $req->fetchAll();
    }

    public static function getAll() {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM families');
        $ret = $req->execute();

        return !$ret ? false : $req->fetchAll();
    }
}

?>
