<?php

namespace TVMaze\API;

use TVMaze\Data\Person;
use TVMaze\TVMazeResource;

use Carbon\Carbon;
use GuzzleHttp\Client as Guzzle;

class People extends Client
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
     * Search people by name
     *
     * @param string $q
     * @return \TVMaze\Data\Person[]
     */
    public function searchMany($q)
    {
        $people = $this->api("search/people", compact('q'));
        $people = array_column($people, 'person');

        if (empty($people)) {
            return null;
        }

        return TVMazeResource::createCollection('people', $people);
    }

    /**
     * Get a person by id
     *
     * @param int $id
     * @param array $embed
     * @return \TVMaze\Data\Person
     */
    public function getById($id, $embed = [])
    {
        $data  = $this->api("people/{$id}", compact('embed'));

        if(! $data){
            return null;
        }

        return new Person($data);
    }

    /**
     * Get cast credits for a person with a given id 
     *
     * @param int $id
     * @param array $embed
     * 
     * @return \TVMaze\Data\CastCredit[]
     */
    public function getCastCredits($id, $embed = [])
    {
        $castcredits = $this->api("people/{$id}/castcredits", compact('embed'));

        if (! $castcredits) {
            return null;
        }

        return TVMazeResource::createCollection('castcredits', $castcredits);
    }

    /**
     * Get crew credits for a person with a given id 
     *
     * @param int $id
     * @param array $embed
     * 
     * @return \TVMaze\Data\CrewCredit[]
     */
    public function getCrewCredits($id, $embed = [])
    {
        $crewcredits = $this->api("people/{$id}/crewcredits", compact('embed'));

        if (! $crewcredits) {
            return null;
        }

        return TVMazeResource::createCollection('crewcredits', $crewcredits);
    }
}