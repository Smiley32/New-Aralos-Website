<?php

class Monsters {
    public static function getLikeName($name) {
        $db = Db::getInstance();

        $name = "%$name%";

        $req = $db->prepare('SELECT * FROM monsters WHERE m_name LIKE :m_name');
        $ret = $req->execute(array('m_name' => $name));

        return !$ret ? false : $req->fetchAll();
    }

    public static function getById($id) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM monsters WHERE m_id=:m_id');
        $ret = $req->execute(array('m_id' => $id));

        return !$ret ? false : $req->fetch();
    }

    public static function getByName($name) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM monsters,images WHERE m_img=img_id AND m_name=:m_name');
        $ret = $req->execute(array('m_name' => $name));

        return !$ret ? false : $req->fetch();
    }

    public static function getByFamily($famId) {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM monsters,images WHERE m_img=img_id AND m_family=:m_family ORDER BY m_type ASC');
        $ret = $req->execute(array('m_family' => $famId));

        return !$ret ? false : $req->fetchAll();
    }

    public static function add($name, $stars, $shortDesc, $imgPath, $familyId, $typeId, $englishName = NULL) {
        // Vérification de l'existence du monstre
        $monster = Monsters::getByName($name);
        if(isset($monster['m_name'])) {
            return false;
        }

        // Vérification de l'existence de la famille
        require_once('models/families.php');
        Families::getById($familyId);
        if(isset($monster['fa_id'])) {
            return false;
        }

        // Vérification de l'existence du type
        require_once('models/types.php');
        Types::getById($typeId);
        if(isset($monster['t_id'])) {
            return false;
        }

        // Ajout de l'image à la base de données
        require_once('models/images.php');
        $imgId = Images::add($imgPath);
        if($imgId === false) {
            return false;
        }

        $db = Db::getInstance();

        // Les autres paramètres doivent déjà être vérifiés
        $req = $db->prepare('INSERT INTO monsters (m_name, m_englishName, m_stars, m_shortDesc, m_img, m_family, m_type) VALUES (:m_name, :m_englishName, :m_stars, :m_shortDesc, :m_img, :m_family, :m_type)');
        $ret = $req->execute(array( 'm_name' => $name,
                                    'm_englishName' => $englishName,
                                    'm_stars' => $stars,
                                    'm_shortDesc' => $shortDesc,
                                    'm_img' => $imgId,
                                    'm_family' => $familyId,
                                    'm_type' => $typeId));

        return $ret;
    }
}

?>
