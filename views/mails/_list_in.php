<div data-role="page" id="Nachrichten">
        <?= $this->render_partial('layouts/_side_menu') ?>
	<div data-role="header" data-theme="a">
                <?= $this->render_partial('layouts/_side_menu_link') ?>
        	<h1>Nachrichten</h1>
        	<a href="#popupMenu" data-rel="popup" data-role="button" data-inline="true">Eingang</a>
        	<div data-role="popup" id="popupMenu" data-theme="a">
				<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="d">
					<li data-role="divider" data-theme="a">Eingang</li>
					<li><a href="<?= $controller->url_for("mails/list_outbox") ?>">Ausgang</a></li>
					<li><a href="<?= $controller->url_for("mails/write") ?>">Neue Nachricht</a></li>
				</ul>
			</div>
	</div><!-- /header -->
      <div data-role="content">
 <? //<ul id="messages" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d"> ?>
 <ul id="swipeMe" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-inset="false" data-divider-theme="d">
<?
//laden der nachrichten 
//wenn eingang leer
if ( empty($inbox) )
{
    ?>
        <li data-theme="e" data-role="list-divider" data-swipeurl=""><center>Keine Nachrichten vorhanden</center></li>
    <?
}
else
{
    //wenn array nicht leer
    foreach ($inbox as $mail)
    {
            if ( ( !$day ) || ( date("j.m.Y",$mail['mkdate']) != $dayCount ) )
            {	
            		$wochentag = \Studip\Mobile\Helper::get_weekday(date("N", $mail['mkdate']));
            		$monat      = \Studip\Mobile\Helper::get_month(date("m", $mail['mkdate']));
            		$day =  $wochentag.date(", j. ",$mail['mkdate']).$monat.date(", Y",$mail['mkdate']);

                    $dayCount = date("j.m.Y",$mail['mkdate']);
                                        ?>
                            <li  data-role="list-divider"><?= $wochentag.date(", j. ",$mail['mkdate']).$monat.date(", Y",$mail['mkdate']); ?></li>
                    <?php
            }
        
            $time = date("H:i",$mail['mkdate']);
    ?>

            <li data-theme="c" data-swipeurl="<?= $controller->url_for("mails/index", $intervall ,$mail['id']) ?>">
                    <a href="<?= $controller->url_for("mails/show_msg", $mail['id']) ?>" data-transition="slideup">
                    <?
                    if ($mail['readed'] == 0)
                    {
                            \Studip\Mobile\Helper::getColorball("#1B4EA9",10);
                    }
                    else
                    {
                            \Studip\Mobile\Helper::getColorball("#000000",10,true);
                    }
                    ?>
                    <h3><?= $mail['author_id'] != '____%system%____' ? Studip\Mobile\Helper::out($mail['author']) : 'Stud.IP-System' ?></h3>
                    <p><strong><?= Studip\Mobile\Helper::out($mail['title']) ?></strong></p>
                
                    <p><?= Studip\Mobile\Helper::fout(mila($mail['message'])) ?>
                    <p class="ui-li-aside"><strong><?= Studip\Mobile\Helper::out($time) ?></strong></p>
            </a></li>

    <?php
    }
?>
<!--
	<li data-theme="e" data-role="list-divider" data-swipeurl=""><a href=""><center>weitere Nachrichten</center></a></li>	
	-->
<?
}
?>
</ul>
</div><!-- /content -->



</div>

