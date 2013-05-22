<img src="<?= $controller->url_for("avatars/show", $activity['author_id']) ?>"
     alt="<?= Studip\Mobile\Helper::out($activity['category']) ?>"
     class="ui-li-icon" style="padding-top: 20px">
 
<img src="<?= $plugin_path ?>/public/images/activities/<?= $activity['category'] ?>.png"
     alt="<?= Studip\Mobile\Helper::out($activity['category']) ?>" class="ui-li-icon">

<h3><?= Studip\Mobile\Helper::out($activity['title']) ?></h3>

<p><strong><?= Studip\Mobile\Helper::out($activity['author']) ?></strong></p>

<p><?= Studip\Mobile\Helper::out($activity['content']) ?></p>

<p class="ui-li-aside"><strong><?= Studip\Mobile\Helper::out($activity['readableTime']) ?></strong></p>
