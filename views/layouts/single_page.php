<? $this->set_layout("layouts/base") ?>

<div data-role="page" id="<?= $page_id ?: '' ?>"  <?= $back_button ? 'data-add-back-btn="true"' : '' ?>>

  <? if (!$no_side_menu) echo $this->render_partial("layouts/side_menu") ?>
  <div data-role="header"  data-theme="<?=TOOLBAR_THEME ?>">
  <? if (!$no_side_menu) echo $this->render_partial("layouts/side_menu_link") ?>
    <h1><?= $page_title ?: 'Stud.IP' ?></h1>
    <a href="<?= $controller->url_for("quickdial") ?>" class="externallink" data-ajax="false" data-icon="grid" data-iconpos="notext" data-theme="d"><?=_("Menu")?></a>

  </div><!-- /header -->

  <div data-role="content">
        <?= $content_for_layout ?>
  </div><!-- /content -->
</div>
