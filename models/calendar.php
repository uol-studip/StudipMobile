<?php

namespace Studip\Mobile;

$RELATIVE_PATH_CALENDAR = $GLOBALS['RELATIVE_PATH_CALENDAR'];
require_once(  $GLOBALS['RELATIVE_PATH_CALENDAR'] . "/lib/DbCalendarMonth.class.php" );


class CalendarModel {

    static function getMonthDates($user_id, $timestamp)
    {
        $_calendar = \Calendar::getInstance($user_id);

        // hat leserechte : $_calendar->havePermission( 2 )
        $cal = new \DbCalendarMonth($_calendar, $timestamp, null, \Calendar::getBindSeminare($user_id) );

        $start_stamp = $cal->getStart() + 0.5 * 86400;
        $end_stamp   = $cal->getEnd();
        $monthDates  =  array();

        for ($act_stamp = $start_stamp; $act_stamp < $end_stamp; $act_stamp += 86400) {
            $event = $cal->getEventsOfDay($act_stamp);

            $dates = array();

            if (isset($event)) {

                foreach ($event as $key => $value) {
                    if ($value != NULL && is_object($value)) {
                        //if is type of CalendarEvent ....
                        if (is_a($value, 'CalendarEvent') || is_a($value, 'SeminarEvent')) {
                            if ($value->getPermission() >= 2) {
                                $dates[$key] = array(
                                    "date"         =>  date("r", $value->getStart()),
                                    "title"        =>  $value->getTitle (),
                                    "start"        =>  date("G:i", $value->getStart()),
                                    "end"          =>  date("G:i", $value->getEnd()),
                                    "description"  =>  $value->getDescription(),
                                    "duration"     =>  date('H:i', $value->getDuration()),
                                    "location"     =>  $value->getLocation());
                            }
                        }
                    }
                }
            }

            $monthDates[date("j", $act_stamp)] = $dates;
        }

        return $monthDates;
    }

    static function getDayDates($user_id, $weekday)
    {
        //get current semester
        $semdata = new \SemesterData();
        $current_semester = $semdata->getCurrentSemesterData();
        $current_semester_id = $current_semester['semester_id'];

        return \CalendarScheduleModel::getEntries($user_id, $current_semester, 0800, 2000, array($weekday-1), false);
    }
}