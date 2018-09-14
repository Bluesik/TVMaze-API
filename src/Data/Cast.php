<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class Cast extends TVMazeResource
{
    public $person;
    public $character;
    public $self;
    public $voice;

    public function __construct ($data = []){
        if(! $data){
            return null;
        }

        $this->person    = array_key_exists('person', $data)    ? new Person($data['person'])       : null;
        $this->character = array_key_exists('character', $data) ? new Character($data['character']) : null;
        $this->self      = array_key_exists('self', $data)      ? $data['self']                     : null;
        $this->voice     = array_key_exists('voice', $data)     ? $data['voice']                    : null;
    }
}