<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class Character extends TVMazeResource
{
    public $id;
    public $url;
    public $name;
    public $images;
    public $links;

    public function __construct ($data = [])
    {
        if(empty($data)){
            return null;
        }

        $this->id       = $data['id'];
        $this->url      = $data['url'];
        $this->name     = $data['name'];
        $this->images   = $data['image'];
        $this->links    = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }
}