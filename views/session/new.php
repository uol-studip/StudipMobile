<? $this->set_layout("layouts/base") ?>

<div data-role="page">

  <div data-role="header">
    <h1>Stud.IP - Login</h1>
  </div><!-- /header -->

  <div data-role="content">

    <center><img src="<?=$plugin_path ?>/public/images/logo.png" style="border:0;width:80%"></center>

    <form action="<?= $controller->url_for('session/create') ?>" method="post" data-ajax="false">
      <div data-role="fieldcontain">
        <label for="username">Nutzername:</label>
        <input type="text" name="username" id="username" value="">
      </div>

      <div data-role="fieldcontain">
        <label for="password">Passwort:</label>
        <input type="password" name="password" id="password" value="">
      </div>

      <input type="submit" value="Login">
    </form>
    <a id="login" href="<? echo URLHelper::getlink($GLOBALS['ABSOLUTE_URI_STUDIP']); ?>" data-role="button" data-theme="e">Zur Webansicht</a>
  </div><!-- /content -->

</div>
