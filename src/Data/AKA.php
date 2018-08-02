<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class AKA extends TVMazeResource
{
    public $name;
    public $country;

    public function __construct ($data = []){
        if(! $data){
            return null;
        }

        $this->name    = $data['name'];
        $this->country = $data['country'];
    }
}