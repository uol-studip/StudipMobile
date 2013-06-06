<?

$page_title = "Kurs: " . Studip\Mobile\Helper::out($course->name);
$page_id = "courses-show";
$back_button = true;
$this->set_layout("layouts/single_page");

// check if there are Geolocations 
$resources_locations = array();

foreach ($resources AS $reso)
{
	if ( is_numeric($reso['latitude']) && is_numeric($reso['longitude']))
	{
		//wenn keine geoinfos: aus array kicken
		$resources_locations[] = $reso;				
	}
}

//ausgabe 

/*if ( $course->visible == 1 )
{
*/
// print title and subtitle
?>

<h2 class="insetText"><?= Studip\Mobile\Helper::out($course->name) ?></h2>
<? if ($course->subtitle) { ?>
    <h4 style="position:relative;top:-15px;"><?= Studip\Mobile\Helper::out($course->subtitle) ?></h4>
<? } 
        

/* var_dump($course->delegate->getUndecoratedData()); */
/* var_dump($course->delegate->getSingleDates()); */

if ($course->metadate)
{
        //termine
        ?>
        <div data-role="collapsible" data-theme="c" data-content-theme="d" class="small_text">
           <h3>Termine</h3>
        <?
        
        // print beginn
        if ($course->metadate->seminarStartTime)
        {
                ?>
                        <div class="ui-grid-b a_bit_smaller_text" data-theme="c" style="font-size:10pt;">
                        	<div class="ui-block-a"><strong>Beginn:</strong></div>
                        	<div class="ui-block-b"><?= \Studip\Mobile\Helper::stamp_to_dat(htmlReady($course->metadate->seminarStartTime)) ?></div>
                        </div><!-- /grid-a -->
                        <div class='little_space'></div>
                <? 
        }
        // print cycledates
        if ($course->metadate->cycles)
        {
        		
                $single_cycledate= true;
                foreach ($course->metadate->cycles AS $cycle_date)
                {
                        ?>
                                <div class="ui-grid-b a_bit_smaller_text" data-theme="c">
                                	<div class="ui-block-a"><strong><?= Studip\Mobile\Helper::out($cycle_date->description) ?></strong></div>
                                	<div class="ui-block-b"><?= \Studip\Mobile\Helper::get_weekday($cycle_date->weekday) ?><br> von <?=Studip\Mobile\Helper::out(substr($cycle_date->start_time, 0,5)) ?> Uhr<br>bis <?= Studip\Mobile\Helper::out(substr($cycle_date->end_time, 0,5)) ?> Uhr</div>
                                	<? 
                                	if(isset($resources[$cycle_date->metadate_id][name]))
                                	{
                                	    ?>
                                	    <div class="ui-block-c">Ort: <?= Studip\Mobile\Helper::out($resources[$cycle_date->metadate_id][name]) ?></div>
                                	    <?
                            	    }
                            	    ?>
                                </div><!-- /grid-b -->
                        <?
                        if ($single_cycledate)
                        {
                            echo "<div class='little_space'></div>";
                            $single_cycledate = false;
                        }
                }
        }
        ?>
                </div>
        
        <?
        	//Beschreibung
        ?>
        <div data-role="collapsible" data-theme="c" data-content-theme="d">
           <h3>Beschreibung</h3>

           <? if ($course->description) : ?>
           <?= \Studip\Mobile\Helper::correctText($course->description) ?>
           <? else : ?>
             <i><?= _("keine Beschreibung") ?></i>
           <? endif ?>
        </div>

        <?
        // sonstiges
        ?>
        <? if (strlen($misc = trim($this->render_partial('courses/_show_misc')))) : ?>
          <div data-role="collapsible" data-theme="c" data-content-theme="d">
            <h3>Weiteres</h3>
            <?= $misc ?>
          </div>
        <? endif ?>

<? } ?>

<br>
<!--
<ul id="course-new-content" data-role="listview" style="margin-top: 1.5em; margin-bottom: 1.5em;">
    <li data-theme="a">News<span class="ui-li-count">1</span></li>
    <li data-theme="a">Forumsbeiträge<span class="ui-li-count">3</span></li>
</ul>
-->

<fieldset class="ui-grid-a">
  <div class="ui-block-a">
    <a href="<?= $controller->url_for("activities/index", $course->id) ?>" data-role="button" data-iconpos="right" data-icon="star" data-theme="b">Kursaktivitäten</a>
  </div>
  <div class="ui-block-b">
  	<?
  		if (!empty($resources_locations))
  		{
	  		?>
	  		 <a href="<?= $controller->url_for("courses/show_map", $course->id) ?>" 
	  		    data-role="button" data-iconpos="right" data-icon="star" data-theme="b"
	  		    class="externallink" data-ajax="false">
	  		    	Karte
	  		 </a>
	  		<?
  		}
  		else
  		{
	  		?>
	  		<a href="#" data-role="button" data-iconpos="right" data-icon="star" data-theme="d">keine Karte</a>
	  		<?
  		}
   ?>
  </div>

  <div class="ui-block-a">
    <a href="<?= $controller->url_for("courses/list_files", $course->id) ?>" data-role="button">Dateien</a>
  </div>
  <div class="ui-block-b">
    <a href="<?= $controller->url_for("courses/show_members", $course->id) ?>"  class="externallink" data-ajax="false" data-role="button" data-iconpos="right" data-icon="" >Teilnehmer</a>
  </div>
</fieldset>


<?
if ( !empty($resources_locations) )
{

	$first_resource = array_shift($resources_locations);
	array_unshift($resources_locations,$first_resource);
?>
<!-- SHOW MAP -->
<script type="text/javascript">
        $(function() {
                var yourStartLatLng = new google.maps.LatLng(<?=$first_resource['latitude'] ?> ,<?=$first_resource['longitude'] ?>);
                $('#map_canvas').gmap({'center': yourStartLatLng,
					zoom: 14, 
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					'disableDefaultUI':true,
					navigationControl: false});
		$('#map_canvas').gmap().bind('init', function() 
		{ 
			<?
			foreach ($resources_locations AS $resource)
			{
				if ( !empty($resource['latitude']) ||  !empty($resource['longitude']))
				?>
				$('#map_canvas').gmap('addMarker', { 'position':  '<?=$resource['latitude'] ?> ,<?=$resource['longitude'] ?>', 'bounds': false}).click(function() 
				{
					$('#map_canvas').gmap('openInfoWindow', { 'content': '<span style="font-weight:bold"><?=Studip\Mobile\Helper::out($resource[name]) ?></span><br><span style="font-weight:normal;"><?=Studip\Mobile\Helper::out($resource[description]) ?></span' }, this);
				});
				<?
			}
			?>  
			                                                                                                                                                                                                                             
		});
        });
</script>
<!-- END SHOW MAP -->
<div class="ui-bar-c ui-corner-all ui-shadow" style="margin-top:2em;">
	<div id="map_canvas" style="height:300px"></div>
</div>

<?
}
?>



<?
/*
}
else
{
        ?>
                <h2>Der Kurs ist leider nicht sichtbar</h2>
        <?
}
*/