<?php

namespace TVMaze\API;

use TVMaze\Data\AKA;
use TVMaze\API\Shows;
use TVMaze\Data\Cast;
use TVMaze\Data\Crew;
use TVMaze\Data\Show;
use TVMaze\API\People;
use TVMaze\Data\Person;
use TVMaze\API\Episodes;
use TVMaze\Data\Episode;
use GuzzleHttp\Client as Guzzle;
use TVMaze\Data\CastCredit;
use TVMaze\Exceptions\NotFoundException;
use TVMaze\Exceptions\BadRequestException;

class Client
{
    /**
     * TVMaze API URL
     */
    const API_URL = 'https://api.tvmaze.com';

    public $shows;
    public $episodes;
    public $people;

    /**
     * Guzzle client
     *
     * @var GuzzleHttp\Client
     */
	protected $guzzle;

    public function __construct()
    {
        $this->guzzle = new Guzzle([
            'base_uri' => self::API_URL
        ]);

        $this->shows    = new Shows($this->guzzle);
        $this->episodes = new Episodes($this->guzzle);
        $this->people   = new People($this->guzzle);
    }

    /**
     * Call TVMaze's API at a given endpoint
     *
     * @param string $endpoint
     * @return array
     */
    protected function api ($endpoint, $query = null)
    {
        $response = $this->guzzle->get($endpoint, [
            'query'      => $query,
            'exceptions' => false
        ]);

        if($response->getStatusCode() !== 200){
            $this->handleFailedRequest($response);
        }

        return $this->parseResponse($response);
    }

    /**
     * Handle failed request
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @return void
     */
    protected function handleFailedRequest ($response){
        $parsedResponse = $this->parseResponse($response);
        $code           = $response->getStatusCode();
        $codes          = [
            400 => BadRequestException::class,
            404 => NotFoundException::class,
            429 => RateLimitingException::class,
        ];

        if(array_key_exists($code, $codes)){
            throw new $codes[$code]($response->getReasonPhrase());
        }

        throw new \Exception($response->getReasonPhrase());
    }

    /**
     * Cast the JSON response into an associative array
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @return array|null
     */
    protected function parseResponse ($response){
        $json = $response->getBody()->getContents();

        return json_decode($json, true);
    }
}
