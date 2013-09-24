<?php

namespace Studip\Mobile;


class News {

    static function find($id)
    {
        return new \StudipNews($id);
    }
}
