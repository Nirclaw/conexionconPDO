<?php

namespace App;

trait system
{
    public function __get($name)
    {
        return $this->{$name};
    }
}
