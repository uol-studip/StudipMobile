<?
$page_title = Studip\Mobile\Helper::out($GLOBALS['UNI_NAME_CLEAN']);
$this->set_layout("layouts/base");

?>
<link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/startscreen.css" />

<?= $this->render_partial("layouts/_side_menu.php") ?>

<div data-role="page" id="<?= $page_id ?: '' ?>" data-scroll='true'>
    <div data-role="header" data-theme="<?= TOOLBAR_THEME ?>">
      <a href="<?= $controller->url_for("session/destroy") ?>" data-role="button"
         data-iconpos="noicon" class="externallink ui-btn-right" data-ajax="false">Logout</a>
        <h1><?= $page_title ?: 'Stud.IP' ?></h1>
    </div>
    <div data-role="content">

      <div class="ui-grid-b" >
          <div class="ui-block-a grid">
            <a href="<?= $controller->url_for("activities") ?>" class="externallink" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/news.png" /><br />
              <span>Activity Stream</span>
            </a>
          </div>
          <div class="ui-block-b grid">
            <a href="<?= $controller->url_for("calendar") ?>"  class="externallink" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/schedule.png" /><br />
              <span>Planer</span>
            </a>
          </div>
          <div class="ui-block-c grid">
            <a href="<?= $controller->url_for("mails") ?>/" class="externallink" data-ajax="false">
              <? if ($number_unread_mails > 0) { ?>
              <span class="notification"><?= $number_unread_mails ?></span>
              <? } ?>
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/mail.png" /><br />
              <span>Nachrichten</span>
            </a>
          </div>

          <div class="ui-block-a grid scndrow">
            <a href="<?= $controller->url_for("courses") ?>" class="externallink" rel="external" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/seminar.png" /><br />
              <span>Kurse</span>
            </a>
          </div>
          <!-- <div class="ui-block-b grid scndrow">
            <a href="<?= $controller->url_for("courses/dropAll") ?>">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/dropbox.png" /><br />
              <span>DropFiles</span>
            </a>
          </div> -->
          <div class="ui-block-c grid scndrow">
            <a href="<?= $controller->url_for("profiles/show",$user_id) ?>"
               class="externallink" rel="external" data-ajax="false">
              <img class="icon" src="<?= $plugin_path ?>/public/images/quickdial/profile.png" /><br />
              <span>Ich</span>
            </a>
          </div>
          <div></div>
      </div>
      <div style="width:70%;height:15px;"></div>
    <?

        if (!empty($next_courses))
        {
                ?>
                        <ul id="nextCourses" data-role="listview" data-inset="true" data-theme="c">
                                <li data-role="list-divider" data-theme="b">Als Nächstes</li>
                <?
        }
    foreach($next_courses as $next)
        {
                ?>
                                <li>
                                        <?
                                                if (strlen($next["id"]) == 32)
            {
              $this_link = $controller->url_for("courses/show", $next["id"]);
            }
                                                else    $this_link = "";
                                        ?>
                                                <a href="<?=$this_link ?>" data-ajax='false'>
                                                <p><strong><?=\Studip\Mobile\Helper::get_weekday($next["weekday"]) ?></strong>
                                                    <?=Studip\Mobile\Helper::out($next["title"]) ?>
                                                </p>
                                                <p>
                                                    <?=Studip\Mobile\Helper::out($next["description"]) ?>
                                                    <span class="ui-li-count">
                                                        <?=Studip\Mobile\Helper::out($next["beginn"])?> - <?=Studip\Mobile\Helper::out($next["ende"])?>
                                                    </span>
                                                </p>
                                                </a>
                                </li>
                <?
        }
        if (!empty($next_courses))
        {
                ?>
                        </ul>
                <?
        }
    ?>

    </div>
</div>
