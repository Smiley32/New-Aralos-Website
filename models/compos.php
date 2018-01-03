<?php

class Compos {
    public static function add($monsters, $categorie, $shortDesc) {
        $db = Db::getInstance();

        require_once('models/categories.php');
        $catId = Categories::add($categorie);
        if($catId == false) {
            return false;
        }

        // Récupération du leader (premier monstre du tableau)
        require_once('models/monsters.php');
        $leader = Monsters::getByName($monsters[0]);
        if($leader == false) {
            return false;
        }

        // Ajout de la compo
        $req = $db->prepare('INSERT INTO compos (comp_leader, comp_shortDesc, comp_cat) VALUES (:comp_leader, :comp_shortDesc, :comp_cat)');
        $ret = $req->execute(array('comp_leader' => $leader['m_id'],
                                    'comp_shortDesc' => $shortDesc,
                                    'comp_cat' => $catId));

        if($ret == false) {
            return false;
        }

        $compId = $db->lastInsertId();

        foreach($monsters as $m) {
            $monster = Monsters::getByName($m);
            if($monster == false) {
                return false;
            }

            // Ajout des monstres à compos_monsters
            $req = $db->prepare('INSERT INTO compos_monsters (cm_compo, cm_monster) VALUES (:cm_compo, :cm_monster)');
            $ret = $req->execute(array('cm_compo' => $compId,
                                        'cm_monster' => $monster['m_id']));

            if($ret == false) {
                return false;
            }
        }


        return true;
    }
}

?>
