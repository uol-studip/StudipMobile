<?
$page_title = "Dateien";
$page_id = "courses-list_files";
$back_button = TRUE;
$this->set_layout("layouts/single_page");
?>

<? if (sizeof($files)) { ?>

  <? if (StudipMobile::DROPBOX_ENABLED) : ?>
  <a href="<?= $controller->url_for("courses/dropfiles", htmlReady($seminar_id)) ?>"
     class="externallink" data-ajax="false" data-role="button"
     data-theme="b">
    Alle Dateien in meine Dropbox
  </a><br>
  <? endif ?>

  <ul id="files" data-role="listview" data-filter="false" data-count-theme="b">
    <? foreach($files as $file) { ?>
      <li>
        <a href="<?=$file["link"] ?>" class="externallink" data-ajax="false">
          <img src="<?=$plugin_path ?><?=$file["icon_link"] ?>" class="ui-li-icon">
          <div style="padding-left:10px;">
            <h3><?= htmlReady($file["name"]) ?></h3>
            <p><strong><?= htmlReady($file["author"]) ?></strong></p>
            <p><?= htmlReady($file["description"]) ?></p>
          </div>
      </a></li>
    <? } ?>
  </ul>

<? } else { ?>
  <ul data-role="listview" data-inset="true" data-theme="e">
    <li>Zu dieser Veranstaltung sind leider keine Dateien vorhanden.</li>
  </ul>
<? } ?>
