<?php

namespace TVMaze\Data;

use TVMaze\TVMazeResource;

class CastCredit extends TVMazeResource
{
    public $links;
    public $show = null;

    public function __construct($data = [])
    {
        if (!$data || empty($data)) {
            return null;
        }

        $this->links = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }
}