<?php

namespace Studip\Mobile;

class Quickdail {

    static function get_number_unread_mails($user_id)
    {
        $query ="SELECT COUNT(*)
                 FROM message_user
                 WHERE user_id = ?
                 AND readed  = 0
                 AND deleted = 0
                 AND snd_rec = 'rec'";

        $stmt = \DBManager::get()->prepare($query);
        $stmt->execute(array($user_id));
        return $stmt->fetchColumn(0);
    }

    static function get_next_courses($user_id)
    {
        $ret = array();

        // get list of all my courses
        $stmt = \DBManager::get()->prepare('SELECT DISTINCT Seminar_id
            FROM seminar_user
            WHERE user_id = ?');
        $stmt->execute(array($user_id));

        $seminar_ids = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        // get upcoming events
        $stmt_next = \DBManager::get()->prepare('SELECT termin_id FROM termine
            WHERE range_id IN (:seminar_ids)
                AND date >= (UNIX_TIMESTAMP() - 3600)
            ORDER BY date ASC LIMIT 3');
        $stmt_next->bindValue(':seminar_ids', $seminar_ids, \StudipPDO::PARAM_ARRAY);

        $stmt_next->execute();

        // return upcoming events
        while ($termin_id = $stmt_next->fetchColumn()) {
            $ret[] = new \SingleDate($termin_id);
        }

        return $ret;
    }
}
