<?php

namespace TVMaze;

use TVMaze\Data\AKA;
use TVMaze\Data\Cast;
use TVMaze\Data\Crew;
use TVMaze\Data\Show;
use TVMaze\Data\Person;
use TVMaze\Data\Season;
use TVMaze\Data\Episode;
use TVMaze\Data\Character;
use TVMaze\Data\CastCredit;
use TVMaze\Data\CrewCredit;

abstract class TVMazeResource
{
    protected static $resources = [
        'show'        => Show::class,
        'shows'       => Show::class,
        'seasons'     => Season::class,
        'episodes'    => Episode::class,
        'nextepisode' => Episode::class,
        'cast'        => Cast::class,
        'castcredits' => CastCredit::class,
        'crewcredits' => CrewCredit::class,
        'crew'        => Crew::class,
        'people'      => Person::class,
        'character'   => Character::class,
        'akas'        => AKA::class,
    ];

    /**
     * Extract embed resources
     *
     * @param array $embed
     * @return void
     */
    protected function extractEmbedData($embed = [])
    {
        foreach ($embed as $resource => $data) {
            if($this->resourceExists($resource)){
                if(! array_key_exists('id', $data)){
                    $this->$resource = static::createCollection($resource, $data);
                }else{
                    $this->$resource = static::createResource($resource, $data);
                }

            }else{
                $this->$resource = $data;
            }
        }
    }

    /**
     * Check if the given resource exists
     *
     * @param string $resource
     * @return bool
     */
    protected function resourceExists ($resource)
    {
        return array_key_exists($resource, static::$resources);
    }

    /**
     * Create a resource collection
     *
     * @param string $resource
     * @param array $items
     * @return array
     */
    public static function createCollection ($resource, $items = [])
    {
        $collection = [];

        foreach ($items as $item) {
            $collection[] = static::createResource($resource, $item);
        }

        return $collection;
    }

    /**
     * Create a resource collection
     *
     * @param string $resource
     * @param array $items
     * @return array
     */
    public static function createResource ($resource, $data)
    {            
        return new static::$resources[$resource]($data);
    }
}