<?php

$this->set_layout("layouts/base");
$page_title = "Kurse";
$page_id = "courses-index";
?>



    <div data-role="page" id="<?= $page_id ?: '' ?>" >
      <?= $this->render_partial("layouts/_side_menu.php") ?>

      <div data-role="header"  data-theme="<?=TOOLBAR_THEME ?>">
        <?= $this->render_partial("layouts/_side_menu_link.php") ?>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
        <a href="<?= $controller->url_for("quickdial") ?>" class="externallink"
           data-ajax="false" data-icon="grid" data-iconpos="notext" data-theme="d"><?=_("Menu")?></a>
      </div><!-- /header -->

      <div data-role="content">

<?
if (sizeof($courses)) {
    echo $this->render_partial('courses/_list.php');
} else { ?>
<p>Sie haben zur Zeit keine Veranstaltungen abonniert, an denen Sie teilnehmen können. Bitte nutzen Sie <a href="#">Veranstaltung suchen / hinzufügen</a> um neue Veranstaltungen aufzunehmen</p>
<? } ?>
      </div><!-- /content -->
