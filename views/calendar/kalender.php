<?
$page_id = "calendar";
$page_title = "Planer";
$body_class = "calendar";
$additional_header = $this->render_partial('calendar/_navbar', array('active' => 'kalender'));
$this->set_layout("layouts/single_page");


$month       = date("n",$stamp);
$day         = date("j");
$year        = date("Y", $stamp);
$daysOfMonth = date("t", $stamp);
$startAt     = date("N", $stamp) - 1;

?>
<div class="ui-grid-a">

  <div class="ui-block-a">
    <div class="calendar_year"><?= $year ?></div>
  </div>

  <div class="ui-block-b">
    <div style="text-align:right;">
      <div data-role="controlgroup" data-type="horizontal" data-mini="true" >
        <a href="<?= $controller->url_for("calendar/kalender", $year - 1, $month) ?>" data-role="button" data-iconpos="notext" data-icon="arrow-l">left</a>
        <a href="<?= $controller->url_for("calendar/kalender", $year + 1, $month) ?>" data-role="button" data-iconpos="notext" data-icon="arrow-r">right</a>
      </div>
    </div>
  </div>
</div>

<table border=0 cellspacing=0 class="calendar_month">
  <tr>
    <td class="<?= $month == 1 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "1") ?>'">JAN</td>
    <td class="<?= $month == 2 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "2") ?>'">FEB</td>
    <td class="<?= $month == 3 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "3") ?>'">MÄR</td>
    <td class="<?= $month == 4 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "4") ?>'">APR</td>
    <td class="<?= $month == 5 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "5") ?>'">MAI</td>
    <td class="<?= $month == 6 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "6") ?>'">JUN</td>
  </tr>
  <tr>
    <td class="<?= $month == 7 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "7") ?>'">JUL</td>
    <td class="<?= $month == 8 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "8") ?>'">AUG</td>
    <td class="<?= $month == 9 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "9") ?>'">SEP</td>
    <td class="<?= $month == 10 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "10") ?>'">OKT</td>
    <td class="<?= $month == 11 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "11") ?>'">NOV</td>
    <td class="<?= $month == 12 ? "calendar_month_activ" : "calendar_month_inactive" ?>" onclick="location.href='<?= $controller->url_for("calendar/kalender", $year, "12") ?>'">DEZ</td>
  </tr>
</table>

<div style="width:100%;height:10px;"></div>

<script type="text/javascript">
  $(document).on("click", ".calendar_cell", function(event) {
    $.mobile.navigate("#day" + $(this).attr("title"));
  });
</script>

<table border=0 cellspacing=0 class="calendar">
  <tr>
<?
$i  = 0;
$jj = 0 - $startAt;
while ($i < $daysOfMonth) {
    $ii = $i+1;
    if ($i % 6 == 0)  echo "</tr><tr>";
?>

    <td class="calendar_cell_<?= $day == $ii ? "active" : "inactive" ?> calendar_cell" title="<?=$ii ?>">
      <center>
        <? for ($j = 1; $j <= $dots[$ii]; $j++) { if ($j >= 4) break; ?>
        <img src="<?= $plugin_path
                  ?>/public/images/icons/calendar_dot.png">
        <? } ?>
      </center>
      <?= $ii ?>
    </td>
<? $i++; } ?>

  </tr>
</table>

<? $additional_pages = $this->render_partial('calendar/_dates') ?>
