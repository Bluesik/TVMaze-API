<?php

namespace TVMaze\Data;

use Carbon\Carbon;
use TVMaze\TVMazeResource;

class Episode extends TVMazeResource
{
    public $id;
    public $url;
    public $name;
    public $season;
    public $number;
    public $airdate;
    public $airtime;
    public $airstamp;
    public $runtime;
    public $images;
    public $summary;
    public $links;

    public function __construct ($data = [])
    {
        if(empty($data)){
            return null;
        }

        $this->id       = $data['id'];
        $this->url      = $data['url'];
        $this->name     = $data['name'];
        $this->season   = $data['season'];
        $this->number   = $data['number'];
        $this->airdate  = $data['airdate'];
        $this->airtime  = $data['airtime'];
        $this->airstamp = Carbon::parse($data['airstamp']);
        $this->runtime  = $data['runtime'];
        $this->images   = $data['image'];
        $this->summary  = strip_tags($data['summary']);
        $this->links    = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }
}