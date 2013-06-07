<?php

class StudipMobile extends StudipPlugin implements SystemPlugin
{
    const DEFAULT_CONTROLLER = "quickdial";

    const DROPBOX_ENABLED = false;

    public function __construct() {
        parent::__construct();
    }


    /**
     * This method dispatches and displays all actions. It uses the template
     * method design pattern, so you may want to implement the methods #route
     * and/or #display to adapt to your needs.
     *
     * @param  string  the part of the dispatch path, that were not consumed yet
     */
    function perform($unconsumed_path) {

        // set include path
        $inc_path = ini_get('include_path') . PATH_SEPARATOR . __DIR__ . '/vendor';
        ini_set('include_path', $inc_path);

        $trails_root = $this->getPluginPath();
        $dispatcher = new Trails_Dispatcher($trails_root,
                                            rtrim(PluginEngine::getURL($this, null, ''), '/'),
                                            self::DEFAULT_CONTROLLER);
        $dispatcher->plugin = $this;
        $dispatcher->dispatch($unconsumed_path);
    }

    // enable nobody role by default
    static function onEnable($id)
    {
        RolePersistence::assignPluginRoles($id, array(7));
    }
}
