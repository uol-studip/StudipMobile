<?php

require "AuthenticatedController.php";
require dirname(__FILE__) . "/../models/profile.php";

use Studip\Mobile\Activity;
use Studip\Mobile\Profile;

/**
 *    get the profile of a user, if visible
 *    @author Nils Bussmann - nbussman@uos.de
 */
class ProfilesController extends StudipMobileAuthenticatedController
{
    function index_action()
    {
        $this->user_id = $this->currentUser()->id;
    }

    function show_action($id = null)
    {
        if ($id == null) {
            $id = $this->currentUser()->id;
        }
        $this->data = Profile::findUser($id);
        $this->cuid = $this->currentUser()->id;
    }
}
