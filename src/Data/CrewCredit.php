<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class CrewCredit extends TVMazeResource
{
    public $type;
    public $links;
    public $show = null;

    public function __construct($data = [])
    {
        if (!$data || empty($data)) {
            return null;
        }

        $this->type  = $data['type'];
        $this->links = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }
}