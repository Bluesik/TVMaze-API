<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class Cast extends TVMazeResource
{
    public $person;
    public $character;

    public function __construct ($data = []){
        if(! $data){
            return null;
        }

        $this->person    = array_key_exists('person', $data)    ? new Person($data['person'])       : null;
        $this->character = array_key_exists('character', $data) ? new Character($data['character']) : null;
    }
}