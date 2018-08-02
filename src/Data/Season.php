<?php

namespace TVMaze\Data;

use Carbon\Carbon;
use TVMaze\TVMazeResource;

class Season extends TVMazeResource
{
    public $id;
    public $url;
    public $number;
    public $name;
    public $episodeOrder;
    public $premiereDate;
    public $endDate;
    public $network;
    public $webChannel;
    public $images;
    public $summary;
    public $links;

    public function __construct ($data = []){
        if(! $data){
            return null;
        }

        $this->id           = $data['id'];
        $this->url          = $data['url'];
        $this->number       = $data['number'];
        $this->name         = $data['name'];
        $this->episodeOrder = $data['episodeOrder'];
        $this->premiereDate = Carbon::parse($data['premiereDate']);
        $this->endDate      = Carbon::parse($data['endDate']);
        $this->network      = $data['network'];
        $this->webChannel   = $data['webChannel'];
        $this->images       = $data['image'];
        $this->summary      = strip_tags($data['summary']);
        $this->links        = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }
}