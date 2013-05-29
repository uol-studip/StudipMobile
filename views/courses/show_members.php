<?
$page_title = "Teilnehmer";
$page_id = "courses-show_members";
$back_button = true;
$this->set_layout("layouts/single_page");

//rolle
$status = '';
?>

<? if (isset($members)) : ?>

<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="d" >
    <? foreach ($members AS $member) {
        if ($status != $member['status']) {
          $status=$member['status'];
    ?>
        <li data-role="list-divider">
          <?= ucfirst(Studip\Mobile\Helper::out($member['status'])) ?>
        </li>
    <? } ?>

    <li>
      <a href=" <?= $controller->url_for("profiles/show", $member['user_id']) ?>" class="externallink" data-ajax="false">
        <?= Avatar::getAvatar($user_id)->getImageTag(Avatar::MEDIUM, array('class' => 'ui-li-thumb')) ?>

        <h3>
          <?=Studip\Mobile\Helper::out($member["title_front"]) ?>
          <?=Studip\Mobile\Helper::out($member['Vorname']) ?>
          <?=Studip\Mobile\Helper::out($member['Nachname'])?>
        </h3>
      </a>
    </li>

    <? } ?>
</ul>

<? else : ?>
    <h3>Diese Veranstaltung hat sehr viele Teilnehmer!</h3>
    <p>Das Laden dieser Seite kann unter Umständen sehr lange dauern.</p>

    <a data-role="button" data-icon="alert" data-inline="true" data-iconpos="right"
       href="<?= $controller->url_for("courses/show_members", $course->id) ?>?deep">Trotzdem laden</a>

<? endif ?>
