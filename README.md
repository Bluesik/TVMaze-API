# TVMaze API - PHP Wrapper

- [TVMaze API - PHP Wrapper](#tvmaze-api---php-wrapper)
    - [Description](#description)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Available methods](#available-methods)
        - [Shows](#shows)
            - [Search shows containing given name](#search-shows-containing-given-name)
            - [Search show by name](#search-show-by-name)
            - [Get show by its id](#get-show-by-its-id)
            - [Get show by TVRage id](#get-show-by-tvrage-id)
            - [Get show by THETVDB id](#get-show-by-thetvdb-id)
            - [Get show by IMDB id](#get-show-by-imdb-id)
            - [Get episodes from a given show's id](#get-episodes-from-a-given-shows-id)
            - [Get a list of seasons for a given show](#get-a-list-of-seasons-for-a-given-show)
            - [Get a cast from a show with a given id](#get-a-cast-from-a-show-with-a-given-id)
            - [Get a crew from a show with a given id](#get-a-crew-from-a-show-with-a-given-id)
            - [Get a list of AKAs from a show with a given id](#get-a-list-of-akas-from-a-show-with-a-given-id)
            - [Get all shows](#get-all-shows-paginated)
            - [Get a list containing information about when each show was last updated](#get-a-list-containing-information-about-when-each-show-was-last-updated)
        - [Episodes](#episodes)
            - [Get a list of all episodes airing in a given country on a given day](#get-a-list-of-all-episodes-airing-in-a-given-country-on-a-given-day)
            - [Get a list of all future episodes airing](#get-a-list-of-all-future-episodes-airing)
            - [Get episode from a show by its season and episode number](#get-episode-from-a-show-by-its-season-and-episode-number)
            - [Get episodes from a show by the given date](#get-episodes-from-a-show-by-the-given-date)
            - [Get a list of episodes for a season with a given id](#get-a-list-of-episodes-for-a-season-with-a-given-id)
        - [People](#people)
            - [Search people by name](#search-people-by-name)
            - [Get a person by id](#get-a-person-by-id)
            - [Get cast credits for a person with a given id](#get-cast-credits-for-a-person-with-a-given-id)
            - [Get crew credits for a person with a given id](#get-crew-credits-for-a-person-with-a-given-id)
    - [License](#license)


## Description

An easy to use PHP Wrapper around TVMaze's API.
All endpoints are supported. (As of Aug 1st 2018)

All TVMaze resources have been turned into objects, so you can interact with them in a OOP way.

For convenience, all dates have been turned into [Carbon](https://carbon.nesbot.com) objects.

## Installation

```
composer require bluesik/tv-maze-api
```

## Usage


```php
<?php

require "vendor/autoload.php";

use TVMaze\API\Client as TVMaze;

// New it up
$tv = new TVMaze();
// Example usage
$data = $tv->shows->getById(123);
```
All embedded resources will be extracted and turned into respective classes (if possible)

Example:
```php
$show = $tv->shows->searchOne('Daredevil', ['episodes']);
var_dump($show->episodes); // Gives you an array of \TVMaze\Data\Episode objects
```

## Available methods

## Shows

#### Search shows containing given name

```php
$tv->shows->searchMany('CSI');
```
#### Params:
- **`String`** `$name`
  - `Name to search for`

> Returns an array of \TVMaze\Data\Show objects or null

---

### Search show by name

```php
$tv->shows->searchOne('Daredevil', ['episodes']); 
```
#### Params:
- **`String`** `$name`
    - `Name to seatch for`
- **`Array`** `$embed`
    - `An array of resources to embed`
    - `Defaults to: An empty array`

> Returns a \TVMaze\Data\Show object or null

---

### Get show by its id

```php
$tv->shows->getById(82, ['episodes']);
```
#### Params:
- **`Integer`** `$id`
    - `Show id`
- **`Array`** `$embed`
    - `An array of resources to embed`
    - `Defaults to: An empty array`

> Returns a \TVMaze\Data\Show object or null

---

### Get show by TVRage id

```php
$tv->shows->getByTVRage(38796);
```
#### Params:
- **`Integer`** `$id`
    - `TVRage id`

> Returns a \TVMaze\Data\Show object or null

---

### Get show by THETVDB id

```php
$tv->shows->getByTVDB(281662);
```
#### Params:
- **`Integer`** `$id`
    - `TVDB id`

> Returns a \TVMaze\Data\Show object or null

---

### Get show by IMDB id

```php
$tv->shows->getByIMDB("tt4122068");
```
#### Params:
- **`Integer`** `$id`
    - `IMDB id`

> Returns a \TVMaze\Data\Show object or null

---

### Get episodes from a given show's id

```php
$tv->shows->getEpisodes(123, $withSpecials = false);
```
#### Params:
- **`Integer`** `$id`
    - `Show id`
- **`Boolean`** `$withSpecials`
    - `Should special episodes be included`
    - `Defualts to: false`

> Returns an array of \TVMaze\Data\Episode objects or null

---

### Get a list of seasons for a given show

```php
$tv->shows->getSeasons(170);
```
#### Params:
- **`Integer`** `$id`
    - `Show id`

> Returns an array of \TVMaze\Data\Season objects or null

---

### Get a cast from a show with a given id
```php
$tv->shows->getCast(170);
```
#### Params:
- **`Integer`** `$id`
    - `Show id`

> Returns an array of \TVMaze\Data\Cast objects or null

---

### Get a crew from a show with a given id
```php
$tv->shows->getCrew(170);
```
#### Params:
- **`Integer`** `$id`
    - `Show id`

> Returns an array of \TVMaze\Data\Crew objects or null

---

### Get a list of AKAs from a show with a given id
```php
$tv->shows->getAKA(170);
```
#### Params:
- **`Integer`** `$id`
    - `Show id`

> Returns an array of \TVMaze\Data\AKA objects or null

---

### Get all shows
```php
$tv->shows->getAll($page = 2);
```
#### Params:
- **`Integer`** `$page`
    - `Which page to get`
    - `Defualts to: 0`

> Returns an array of \TVMaze\Data\Show objects or null

---

### Get a list containing information about when each show was last updated
```php
$tv->shows->getUpdates();
```

> Returns an array or null

## Episodes

## Get a list of all episodes airing in a given country on a given day
```php
$tv->episodes->getSchedule("US", "2018-01-01");
```
#### Params:
- **`String`** `$country`
    - `An ISO 3166-1 code of the country`
    - `Defualts to: US`
- **`String`** `$date`
    - `An ISO 8601 formatted date`
    - `Defualts to: <current date>`

> Returns an array of \TVMaze\Data\Episode objects or null

---

## Get a list of all future episodes airing
```php
$tv->episodes->getFullSchedule();
```

> Returns an array of \TVMaze\Data\Episode objects or null

---

## Get episode from a show by its season and episode number
```php
$tv->episodes->getById($show = 82, $season = 2, $episode = 2);
```
#### Params:
- **`Integer`** `$show`
    - `Show id`
- **`Integer`** `$season`
    - `Season number`
    - `Defualts to: 1`
- **`Integer`** `$episode`
    - `Episode number`
    - `Defualts to: 1`

> Returns a \TVMaze\Data\Episode object or null

---

## Get episodes from a show by the given date
```php
$tv->episodes->getByDate($show = 335, $date = "2017-01-01");
```
- **`Integer`** `$show`
    - `Show id`
- **`String`** `$date`
    - `An ISO 8601 formatted date`
    - `Defualts to: <current date>`

> Returns an array of \TVMaze\Data\Episode objects or null

--- 

## Get a list of episodes for a season with a given id
```php
$tv->episodes->getFromSeason(772);
```
- **`Integer`** `$season`
    - `Season id`
    
> Returns an array of \TVMaze\Data\Episode objects or null

#People

## Search people by name
```php
$tv->people->searchMany('Gordon');
```
- **`String`** `$name`
    - `Name to look for`

> Returns an array of \TVMaze\Data\Person objects or null

---

## Get a person by id
```php
$tv->people->getById(40682, ['castcredits']);
```
- **`Integer`** `$person`
    - `Person id`
- **`Array`** `$embed`
    - `An array of resources to embed`
    - `Defaults to: An empty array`

> Returns a \TVMaze\Data\Person object or null

---

## Get cast credits for a person with a given id 
```php
$tv->people->getCastCredits(40682, ['show']);
```
- **`Integer`** `$person`
    - `Person id`
- **`Array`** `$embed`
    - `An array of resources to embed`
    - `Defaults to: An empty array`

> Returns an array of \TVMaze\Data\CastCredit objects or null

---

## Get crew credits for a person with a given id
```php
$tv->people->getCrewCredits(40682, ['show']);
```
- **`Integer`** `$person`
    - `Person id`
- **`Array`** `$embed`
    - `An array of resources to embed`
    - `Defaults to: An empty array`

> Returns an array of \TVMaze\Data\CrewCredit objects or null

## License

MIT
