<?
$page_title = "Nachricht";
$page_id = "mail-show";
$this->set_layout("layouts/base");
?>

<div data-role="page" id="<?= $page_id ?: '' ?>" >

  <?= $this->render_partial('layouts/_side_menu') ?>

  <div data-role="header" data-theme="<?=TOOLBAR_THEME ?>">
    <?= $this->render_partial('layouts/_side_menu_link') ?>
    <h1><?= $page_title ?: 'Stud.IP' ?></h1>
    <a href="javascript:history.back();" class="externallink" data-ajax="false" data-icon="check" data-transition="slidedown" data-theme="<?=TOOLBAR_ABORT ?>" class="externallink" data-ajax="false">Fertig</a>
  </div><!-- /header -->

  <div data-role="content"  style="padding:15px 3px 0px;">
<?
if (sizeof($mail)) 
{
        $time = date("H:i",$mail[0]['mkdate']);
        $wochentag = \Studip\Mobile\Helper::get_weekday(date("N", $mail[0]['mkdate']));
		$monat      = \Studip\Mobile\Helper::get_month(date("m", $mail[0]['mkdate']));
		$day = $wochentag.date(", j. ",$mail[0]['mkdate']).$monat.date(", Y",$mail[0]['mkdate']);
        ?>
        <ul data-role="listview">
        			<li data-role="fieldcontain">

        					<h3><?= htmlReady($mail[0]['title']) ?></h3>
        					<p><strong><?=$day ?> </strong></p>
        			</li>
        			<li data-role="fieldcontain">
        					<p style="padding-top:12px;">
        					        <strong>An:</strong> <?= htmlReady($mail[0]['receiver']) ?><br>
        						<strong>Von:</strong> <?= htmlReady($mail[0]['author']) ?>
        					</p>
        					<span class="ui-li-count"> <?=$time ?> Uhr</span>
        			</li>
        </ul>
        <p style="font-family: Helvetica,Arial,sans-serif;font-size: 12px;font-weight: normal;white-space:wrap;">
        	<br />
        	<?= htmlReady($mail[0]['message'],TRUE, TRUE); ?>
        </p>
        <?php
}
else
{
        ?>
        <p>Beim Laden der Nachricht ist ein Fehler aufgetreten.</p>
        <?
}
?>
</div><!-- /content -->


  <div data-role="footer" data-id="footer" data-position="fixed" data-theme="c">
    <div data-role="navbar" data-iconspos="top">
      <ul class="ui-grid-a">
        <li class="ui-block-a"><a id="marikieren" href="<?= $controller->url_for("mails/show_msg",htmlReady($mail[0]['id']), htmlReady(true)) ?>" data-theme="c" data-icon="star" data-transition="flip">Markieren</a></li>
        <li class="ui-block-b"><a id="antworten" href="<?= $controller->url_for("mails/write",htmlReady($mail[0]['author_id'])) ?>" data-theme="c" data-icon="check" data-transition="slideup">Antworten</a></li>
      </ul>
    </div>
  </div>

</div>
