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
        //get current semester
        $semdata = new \SemesterData();
        $current_semester    = $semdata->getCurrentSemesterData();
        $current_semester_id = $current_semester['semester_id'];

        $entries = \CalendarScheduleModel::getEntries($user_id, $current_semester, 0, 2000, range(0, 6), false);

        $output  = array();
        $counter = 0;
        $currentWeekDay = date("N") - 1;
        $currentTime = date("Gi");

        if (!empty($entries)) {
            for ($offset = 0; $offset < 7; $offset++) {

                $day_pt = ($currentWeekDay + $offset) % 6;
                $currentDayObject = $entries[$day_pt];

                if (!empty($currentDayObject)) {

                    //sortieren der einträge des tages
                    $tmp = $currentDayObject->getEntries();
                    uasort($tmp, '\Studip\Mobile\Helper::cmpEarlier');
                    foreach ($tmp as $entry) {


                        if ($entry["ende"] > $currentTime || $day_pt != $currentWeekDay)
                        {
                            $output[] = array(
                                "title"       => $entry["title"],
                                "description" => $entry["content"],
                                "beginn"      => $entry["start_formatted"],
                                "ende"        => $entry["end_formatted"],
                                "weekday"     => $pt + 1,
                                "id"          => substr($entry["id"], 0, 32));
                            if (sizeof($output) >= 3) {
                              break;
                            }
                        }
                    }
                }
            }
        } else {
            return null;
        }

        return $output;
    }
}
