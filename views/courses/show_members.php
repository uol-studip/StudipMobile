<?

$page_title = "Teilnehmer";
$page_id = "courses-show_members";
$back_button = true;
$this->set_layout("layouts/single_page");

//rolle
$status = '';
?>



<ul id="courses" data-role="listview" data-filter="true" data-filter-placeholder="Suchen" data-divider-theme="d" >
<?
	foreach ($members AS $member)   
	{
		if ($status != $member['status'])
		{
		$status=$member['status'];
		?>
			<li data-role="list-divider">
	         <?=ucfirst(Studip\Mobile\Helper::out($member['status'])) ?>
	        </li>
	    <?
		}
		?>
        <li>
	        <a href=" <?= $controller->url_for("profiles/show", $member['user_id']) ?>" class="externallink" data-ajax="false">
		        <img src="<?= $controller->url_for("avatars/show", $member['user_id'], 'medium') ?>" class="ui-li-thumb">
		        <h3><?=Studip\Mobile\Helper::out($member["title_front"]) ?> 
		            <?=Studip\Mobile\Helper::out($member['Vorname']) ?>  
		            <?=Studip\Mobile\Helper::out($member['Nachname'])?> 
		        </h3>
		    </a>
        </li>
    <?
    }
    ?>
</ul>