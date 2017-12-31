<?php

class Guild {
    public static function getById($id) {
        $db = Db::getInstance();
        
        $req = $db->prepare('SELECT * FROM guild WHERE g_id=:g_id');
        $ret = $req->execute(array('g_id' => $id));

        return !$ret ? false : $req->fetch();
    }

    public static function addUser($userId, $guildId) {
        $db = Db::getInstance();

        $req = $db->prepare('INSERT INTO user_guild (ug_user, ug_guild) VALUES (:ug_user, :ug_guild)');
        $ret = $req->execute(array( 'ug_user' => $userId,
                                    'ug_guild' => $guildId));

        return $ret;
    }
}

?>