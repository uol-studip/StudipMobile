<?php

$groups = array();
foreach ($courses as $course) {
    if (!isset($groups[$course['sem_number']])) {
        $groups[$course['sem_number']] = array();
    }
    $groups[$course['sem_number']][] = $course;
}

krsort($groups);
?>

<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="b">
    <? foreach ($groups as $sem_key => $group) { ?>
        <li data-role="list-divider">
             <?= Studip\Mobile\Helper::out($semester[$sem_key]['name']) ?>
        </li>
        <? foreach ($group as $course) { ?>

            <li class="course" data-course="<?= $course['Seminar_id'] ?>">
                <a href="<?= $controller->url_for("courses/show", $course['Seminar_id']) ?>"  class="externallink" data-ajax="false">
                    <? \Studip\Mobile\Helper::getColorball($course["color"]); ?>
                    <h3><?= Studip\Mobile\Helper::out($course['Name']) ?></h3>
                </a>
            </li>
        <? } ?>
    <? } ?>
</ul>
