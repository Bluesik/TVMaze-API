<?php

namespace TVMaze\API;

use TVMaze\TVMazeResource;
use TVMaze\Data\Show;

use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;

class Shows extends Client
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
     * Search shows containing given name
     *
     * @param string $q
     * @return \TVMaze\Data\Show[]|null
     */
    public function searchMany($q)
    {
        $shows = $this->api("search/shows", compact('q'));
        $shows = array_column($shows, 'show');

        if (empty($shows)) {
            return null;
        }

        return TVMazeResource::createCollection('shows', $shows);
    }

    /**
     * Search show by name
     *
     * @param string $q
     * @param array $embed
     * @return \TVMaze\Data\Show|null
     */
    public function searchOne ($q, $embed = [])
    {
        $data  = $this->api("singlesearch/shows", compact('q', 'embed'));

        if (! $data) {
            return null;
        }

        return new Show($data);
    }

    /**
     * Get show by TVRage id
     *
     * @param int $id
     * @return \TVMaze\Data\Show|null
     */
    public function getByTVRage($id)
    {
        $data = $this->api("lookup/shows", [ "tvrage" => $id ]);

        if (! $data) {
            return null;
        }

        return new Show($data);
    }

    /**
     * Get show by THETVDB id
     *
     * @param int $id
     * @return \TVMaze\Data\Show|null
     */
    public function getByTVDB($id)
    {
        $data = $this->api("lookup/shows", [ "thetvdb" => $id]);

        if (! $data) {
            return null;
        }

        return new Show($data);
    }

    /**
     * Get show by IMDB id
     *
     * @param string $id
     * @return \TVMaze\Data\Show|null
     */
    public function getByIMDB($id)
    {
        $data = $this->api("lookup/shows", [ "imdb" => $id ]);

        if (! $data) {
            return null;
        }

        return new Show($data);
    }

    /**
     * Get show by its id
     *
     * @param int $id
     * @param array $embed
     * @return \TVMaze\Data\Show|null
     */
    public function getById($id, $embed = [])
    {
        $data  = $this->api("shows/{$id}", compact('embed'));

        if(! $data){
            return null;
        }

        return new Show($data);
    }

    /**
     * Get episodes from a given show's id
     *
     * @param int $id
     * @return \TVMaze\Data\Episode[]
     */
    public function getEpisodes($id, $withSpecials = false)
    {
        $specials = $withSpecials ? 1 : 0;
        $episodes = $this->api("shows/{$id}/episodes", compact('specials'));

        if (empty($episodes)) {
            return null;
        }

        return TVMazeResource::createCollection('episodes', $episodes);
    }

    /**
     * Get a list of seasons for a given show
     * @param int $show
     * @return \TVMaze\Data\Season[]|null
     */
    public function getSeasons($show)
    {
        $seasons = $this->api("shows/{$show}/seasons");

        if (!$seasons) {
            return null;
        }

        return TVMazeResource::createCollection('seasons', $seasons);
    }

    /**
     * Get a cast from a show with a given id
     * @param int $show
     * @return \TVMaze\Data\Cast[]|null
     */
    public function getCast($show)
    {
        $cast = $this->api("shows/{$show}/cast");

        if (! $cast) {
            return null;
        }

        return TVMazeResource::createCollection('cast', $cast);
    }

    /**
     * Get a crew from a show with a given id
     * @param int $show
     * @return \TVMaze\Data\Crew[]|null
     */
    public function getCrew($show)
    {
        $crew = $this->api("shows/{$show}/crew");

        if (! $crew) {
            return null;
        }

        return TVMazeResource::createCollection('crew', $crew);
    }

    /**
     * Get a list of AKAs from a show with a given id
     * @param int $show
     * @return \TVMaze\Data\AKA[]|null
     */
    public function getAKA($show)
    {
        $akas = $this->api("shows/{$show}/akas");

        if (!$akas) {
            return null;
        }

        return TVMazeResource::createCollection('akas', $akas);
    }

    /**
     * Get all shows
     *
     * @param int $page
     * @return \TVMaze\Data\Show[]
     */
    public function getAll($page = 0)
    {
        $shows = $this->api("shows", compact('page'));

        return TVMazeResource::createCollection('shows', $shows);
    }

    /**
     * Get a list containing information about when each show was last updated
     *
     * @return array|null
     */
    public function getUpdates()
    {
        $list    = [];
        $updates = $this->api("updates/shows");

        if (! $updates) {
            return null;
        }

        foreach($updates as $id => $timestamp){
            $list[$id] = Carbon::createFromTimestamp($timestamp);
        }

        return $list;
    }
}