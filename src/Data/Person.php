<?php

namespace TVMaze\Data;

use Carbon\Carbon;
use TVMaze\TVMazeResource;

class Person extends TVMazeResource
{
    public $id;
    public $url;
    public $name;
    public $country;
    public $birthday;
    public $deathday;
    public $gender;
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
        $this->country  = $data['country'];
        $this->birthday = $data['birthday'] ? Carbon::parse($data['birthday']): null;
        $this->deathday = $data['deathday'] ? Carbon::parse($data['deathday']): null;
        $this->gender   = $data['gender'];
        $this->images   = $data['image'];
        $this->links    = $data['_links'];

        if(array_key_exists('_embedded', $data)){
            $this->extractEmbedData($data['_embedded']);
        }
    }

    /**
     * Check if the given person has died
     *
     * @return bool
     */
    public function hasDied ()
    {
        return !! $this->deathday;
    }
}