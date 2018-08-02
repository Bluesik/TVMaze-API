<?php

namespace TVMaze\API;

use TVMaze\TVMazeResource;
use TVMaze\Data\Episode;

use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;

class Episodes extends Client
{
    /**
     * Guzzle client
     *
     * @var GuzzleHttp\Client
     */
    protected $guzzle;

    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * Get a list of all episodes airing in a given country on a given day
     *
     * @param string $country
     * @param string $date
     * @return \TVMaze\Data\Episode[]
     */
    public function getSchedule($country = 'US', $date = null)
    {
        $date     = $date ?? date('Y-m-d');
        $episodes = $this->api("schedule", compact('country', 'date'));

        if(empty($episodes)){
            return null;
        }

        return TVMazeResource::createCollection('episodes', $episodes);
    }

    /**
     * Get a list of all future episodes airing
     *
     * @return \TVMaze\Data\Episode[]|null
     */
    public function getFullSchedule()
    {
        $episodes = $this->api("schedule/full");

        if(empty($episodes)){
            return null;
        }

        return TVMazeResource::createCollection('episodes', $episodes);
    }

    /**
     * Get episode from a show by its season and episode number
     *
     * @param int $show
     * @param int $season
     * @param int $episode
     * @return \TVMaze\Data\Episode
     */
    public function getById($show, $season = 1, $number = 1)
    {
        $data = $this->api("shows/{$show}/episodebynumber", compact('season', 'number'));

        if(! $data){
            return null;
        }

        return new Episode($data);
    }

    /**
     * Get episodes from a show by the given date
     * @param int $show
     * @param string $date
     * @return \TVMaze\Data\Episode[]|null
     */
    public function getByDate($show, $date = null)
    {
        $date     = $date ?? date('Y-m-d');
        $episodes = $this->api("shows/{$show}/episodesbydate", compact('date'));

        if (!$episodes) {
            return null;
        }

        return TVMazeResource::createCollection('episodes', $episodes);
    }

    /**
     * Get a list of episodes for a season with a given id
     * @param int $season
     * @return \TVMaze\Data\Episode[]|null
     */
    public function getFromSeason($season)
    {
        $episodes = $this->api("seasons/{$season}/episodes");

        if (!$episodes) {
            return null;
        }

        return TVMazeResource::createCollection('episodes', $episodes);
    }
}