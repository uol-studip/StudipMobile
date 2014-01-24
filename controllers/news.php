<?php

require "StudipMobileAuthenticatedController.php";
require dirname(__FILE__) . "/../models/news.php";

use Studip\Mobile\News;

/**
 *    @author mlunzena@uos.de
 */
class NewsController extends StudipMobileAuthenticatedController
{
    function show_action($id)
    {
        $this->news = News::find($id);
    }
}
