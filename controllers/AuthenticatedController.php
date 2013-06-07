<?php

require_once 'StudipMobileController.php';

/**
 *    global usefull stuff
 *    @author Marcus Lunzenauer - mlunzena@uos.de
 *    @author André Klaßen - aklassen@uos.de
 *    @author Nils Bussmann - nbussman@uos.de
 */
class AuthenticatedController extends StudipMobileController
{
    function before_filter(&$action, &$args)
    {
        parent::before_filter($action, $args);

        # require a logged in User or else redirect to session/new
        $this->requireUser();
    }
}
