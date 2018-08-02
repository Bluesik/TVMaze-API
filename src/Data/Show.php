<?php

namespace TVMaze\Data;

use Carbon\Carbon;
use TVMaze\TVMazeResource;

class Show extends TVMazeResource
{
    public $id;
    public $url;
    public $name;
    public $type;
    public $language;
    public $genres;
    public $status;
    public $runtime;
    public $premiered;
    public $officialSite;
    public $schedule;
    public $rating;
    public $weight;
    public $network;
    public $webChannel;
    public $externals;
    public $images;
    public $summary;
    public $links;

    public function __construct ($data = [])
    {
        if(empty($data)){
            return null;
        }

        $this->id           = $data['id'];
        $this->url          = $data['url'];
        $this->name         = $data['name'];
        $this->type         = $data['type'];
        $this->language     = $data['language'];
        $this->genres       = $data['genres'];
        $this->status       = $data['status'];
        $this->runtime      = $data['runtime'];
        $this->premiered    = Carbon::parse($data['premiered']);
        $this->officialSite = $data['officialSite'];
        $this->schedule     = $data['schedule'];
        $this->rating       = $data['rating'];
        $this->weight       = $data['weight'];
        $this->network      = $data['network'];
        $this->webChannel   = $data['webChannel'];
        $this->externals    = $data['externals'];
        $this->images       = $data['image'];
        $this->summary      = strip_tags($data['summary']);
        $this->updated      = Carbon::createFromTimestamp($data['updated']);
        $this->links        = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }
}