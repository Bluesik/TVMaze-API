<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class Crew extends TVMazeResource
{
    public $type;
    public $person;

    public function __construct ($data = []){
        if(! $data){
            return null;
        }

        $this->type   = $data['type'];
        $this->person = array_key_exists('person', $data) ? new Person($data['person']) : null;
    }
}