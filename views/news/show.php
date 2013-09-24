<?

use Studip\Mobile\Helper;

$page_title = 'Ankündigung: "' . Helper::out($news->topic) . '"';
$page_id = "news-show";
$back_button = true;
$this->set_layout("layouts/single_page");

$day = date("j.m.Y", $news->chdate);
$time = date("H:i", $news->chdate);
?>

<ul data-role="listview">
  <li data-role="fieldcontain">
    <h3><?= Helper::out($news->topic) ?></h3>
  </li>

  <li data-role="fieldcontain">
    <p style="padding-top:12px;">
      <strong>Von:</strong> <?= Helper::out($news->author) ?>
    </p>
    <span class="ui-li-count"> <?= Helper::out($day) ?> um <?= $time ?> Uhr</span>
  </li>
</ul>
<p style="font-family: Helvetica,Arial,sans-serif;font-size: 12px;font-weight: normal;white-space:wrap;">
  <br />
  <?= Helper::fout($news->body) ?>
</p>
