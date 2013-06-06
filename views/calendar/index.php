<?
$page_id = "timetable";
$page_title = "Planer";
$body_class = "calendar";
$additional_header = $this->render_partial('calendar/_navbar', array('active' => 'index'));
$this->set_layout("layouts/single_page");

$month = date("n");
$day = date("j");
$year = date("Y");
?>

<div class="calendar_year"><?=\Studip\Mobile\Helper::get_weekday($weekday) ?></div>

<table border=0 cellspacing=0 class="calendar_month">
  <tr>
    <td class="<?= $weekday == 1 ? "calendar_month_activ":"calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/index", "1") ?>'">MON</td>
    <td class="<?= $weekday == 2 ? "calendar_month_activ":"calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/index", "2") ?>'">DIE</td>
    <td class="<?= $weekday == 3 ? "calendar_month_activ":"calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/index", "3") ?>'">MIT</td>
    <td class="<?= $weekday == 4 ? "calendar_month_activ":"calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/index", "4") ?>'">DON</td>
    <td class="<?= $weekday == 5 ? "calendar_month_activ":"calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/index", "5") ?>'">FRE</td>
    <td class="<?= $weekday == 6 ? "calendar_month_activ":"calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/index", "6") ?>'">SAM</td>
  </tr>
</table>

<div style="width:100%;height:20px;"></div>

<?
$no_entries = true;

if (array_key_exists(($weekday-1), $termine)) {
    if (array_key_exists("entries", $termine[$weekday-1])) {
        $calendar_col = $termine[$weekday-1];

        $array= $calendar_col->sortEntries();
        if (array_key_exists("col_0", $array)) {
            foreach ($array["col_0"] as $termin ) {
                if (strlen($termin['id']) >=32) {
                    $link = $controller->url_for("courses/show", substr($termin['id'],0,32));
                } else {
                    $link = "";
                } ?>


                <div class="calendar_time" onclick="location.href='<?=$link ?>'">
                  <?=substr($termin["start"],0,2) ?>:<?=substr($termin["start"],2,2) ?> -
                  <?=substr($termin["end"],0,2) ?>:<?=substr($termin["end"],2,2) ?>:
                </div>

                <div class="calendar_bubble"  onclick="location.href='<?=$link ?>'">
                  <strong><?=Studip\Mobile\Helper::out($termin["content"]) ?> </strong>
                  <?=Studip\Mobile\Helper::out($termin["title"]) ?>
                </div>
                <?
            }
            $no_entries = false;
        }
    }
}

if ($no_entries == true) { ?>
    <div class="calendar_bubble">Es sind keine Einträge vorhanden.</div>
<? } ?>
