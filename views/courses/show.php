<?
$page_title = "Kurs: " . Studip\Mobile\Helper::out($course->name);
$page_id = "courses-show";
$back_button = true;
$this->set_layout("layouts/single_page");

// check if there are Geolocations
$resources_locations = array_filter($resources, function ($resource) {
        return is_numeric($resource['latitude']) && is_numeric($resource['longitude']);
    });
?>

<h2><?= Studip\Mobile\Helper::out($course->name) ?></h2>
<? if ($course->subtitle) { ?>
    <h4><?= Studip\Mobile\Helper::out($course->subtitle) ?></h4>
<? } ?>

<? if ($course->metadate) { ?>
    <div data-role="collapsible" data-theme="c" data-content-theme="d" class="small_text">
      <h3>Termine</h3>
      <? if ($course->metadate->seminarStartTime) { ?>
      <div class="ui-grid-b a_bit_smaller_text" data-theme="c" style="font-size:10pt;">
        <div class="ui-block-a"><strong>Beginn:</strong></div>
        <div class="ui-block-b"><?= \Studip\Mobile\Helper::stamp_to_dat(htmlReady($course->metadate->seminarStartTime)) ?></div>
      </div><!-- /grid-a -->
      <div class='little_space'></div>
      <? } ?>


      <? if ($course->metadate->cycles) {
        $single_cycledate= true;
        foreach ($course->metadate->cycles as $cycle_date) { ?>

            <div class="ui-grid-b a_bit_smaller_text" data-theme="c">
              <div class="ui-block-a"><strong><?= Studip\Mobile\Helper::out($cycle_date->description) ?></strong></div>
              <div class="ui-block-b"><?= \Studip\Mobile\Helper::get_weekday($cycle_date->weekday) ?><br> von <?=Studip\Mobile\Helper::out(substr($cycle_date->start_time, 0,5)) ?> Uhr<br>bis <?= Studip\Mobile\Helper::out(substr($cycle_date->end_time, 0,5)) ?> Uhr</div>
              <? if (isset($resources[$cycle_date->metadate_id][name])) { ?>
                  <div class="ui-block-c">Ort: <?= Studip\Mobile\Helper::out($resources[$cycle_date->metadate_id][name]) ?></div>
              <? } ?>
            </div><!-- /grid-b -->

            <? if ($single_cycledate) { $single_cycledate = false; ?>
                <div class='little_space'></div>
            <? } ?>
        <? } ?>
      <? } ?>
    </div>

    <div data-role="collapsible" data-theme="c" data-content-theme="d">
      <h3>Beschreibung</h3>

      <? if ($course->description) : ?>
          <?= \Studip\Mobile\Helper::correctText($course->description) ?>
      <? else : ?>
          <i><?= _("keine Beschreibung") ?></i>
      <? endif ?>
    </div>

    <? if (strlen($misc = trim($this->render_partial('courses/_show_misc')))) : ?>
        <div data-role="collapsible" data-theme="c" data-content-theme="d">
          <h3>Weiteres</h3>
          <?= $misc ?>
        </div>
    <? endif ?>

<? } ?>

<br>

<fieldset class="ui-grid-a">

  <div class="ui-block-a">
    <a href="<?= $controller->url_for("activities/index", $course->id) ?>" data-role="button" data-iconpos="right" data-icon="star" data-theme="b">Kursaktivitäten</a>
  </div>

  <div class="ui-block-b">
    <? if (!empty($resources_locations)) { ?>
        <a href="<?= $controller->url_for("courses/show_map", $course->id) ?>"
           data-role="button" data-iconpos="right" data-icon="star" data-theme="b"
           class="externallink" data-ajax="false">
            Karte
        </a>
    <? } else { ?>
        <a href="#" data-role="button" data-iconpos="right" data-icon="star" data-theme="d">keine Karte</a>
    <? } ?>
  </div>


  <div class="ui-block-a">
    <a href="<?= $controller->url_for("courses/list_files", $course->id) ?>" data-role="button">Dateien</a>
  </div>

  <div class="ui-block-b">
    <a href="<?= $controller->url_for("courses/show_members", $course->id) ?>"  class="externallink" data-ajax="false" data-role="button" data-iconpos="right" data-icon="" >Teilnehmer</a>
  </div>
</fieldset>


<? if (sizeof($resources_locations))  {
  $first_resource = array_shift($resources_locations);
  array_unshift($resources_locations,$first_resource);
?>

    <script>
    $(function() {
      var yourStartLatLng = new google.maps.LatLng(<?= $first_resource['latitude'] ?>, <?= $first_resource['longitude'] ?>);
      $('#map_canvas').gmap({
        center: yourStartLatLng,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        navigationControl: false});

      $('#map_canvas').gmap().bind('init', function() {
        <? foreach ($resources_locations as $resource) : ?>
          <? if (sizeof($resource['latitude']) || sizeof($resource['longitude'])) ?>
            $('#map_canvas').gmap('addMarker', {
                'position': '<?=$resource['latitude'] ?> ,<?=$resource['longitude'] ?>',
                'bounds': false})
              .click(function() {
                $('#map_canvas').gmap('openInfoWindow', {
                  'content': '<span style="font-weight:bold"><?= Studip\Mobile\Helper::out($resource[name]) ?></span><br><span style="font-weight:normal;"><?=Studip\Mobile\Helper::out($resource[description]) ?></span'
                }, this);
            });
        <? endforeach ?>
      });
    });
    </script>


    <div class="ui-bar-c ui-corner-all ui-shadow" style="margin-top:2em;">
      <div id="map_canvas" style="height:300px"></div>
    </div>

<? } ?>
