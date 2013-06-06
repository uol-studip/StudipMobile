<div data-role="panel" id="leftpanel" data-display="push" data-theme="a">
    <h2>Menü</h2>

    <ul data-role="listview" data-theme="a" class="nav-search" data-inset="false" id="menu_side">

      <li class="active" data-icon="false">
        <a href="<?= $controller->url_for("quickdial") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/quick.png" class="ui-li-icon ui-corner-none">
          Start
        </a>
      </li>

      <li data-icon="false">
        <a href="<?= $controller->url_for("activities") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/news.png" class="ui-li-icon ui-corner-none">
          Activity Stream
        </a>
      </li>

      <li data-icon="false">
        <a href="<?= $controller->url_for("calendar") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/schedule.png" class="ui-li-icon ui-corner-none">
          Planer
        </a>
      </li>

      <li data-icon="false">
        <a href="<?= $controller->url_for("mails") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/mail.png"   class="ui-li-icon ui-corner-none" />
          Nachrichten
        </a>
      </li>

      <li data-icon="false">
        <a href="<?= $controller->url_for("courses") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/seminar.png"   class="ui-li-icon ui-corner-none" />
          Kurse
        </a>
      </li>

      <li data-icon="false">
        <a href="<?= $controller->url_for("profiles/show") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/profile.png"   class="ui-li-icon ui-corner-none" />
          Ich
        </a>
      </li>

      <li data-icon="false">
        <a href="<?= $controller->url_for("session/destroy") ?>" class="externallink contentLink" data-ajax="false">
          <img src="<?= $plugin_path ?>/public/images/quickdial/bw/logout.png"   class="ui-li-icon ui-corner-none" />
          Logout
        </a>
      </li>    
    </ul>
</div><!-- /panel -->
