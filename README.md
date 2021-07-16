# KEYWORD SCORE

This repository holds the code and script

## Setup the Project

* Make sure you have [Composer installed](https://getcomposer.org/).

* In a terminal, move into the project, then install the composer dependencies:

```bash
composer install
```

* In .env file paste your Personal access token from GitHub
```bash
AUTH_TOKEN='you_access_token'
```

* Load up your database

This project uses an MYSQL database, which normally is supported by PHP
out of the box.

To load up your database file, run:

```bash
php bin/console doctrine:schema:update --force
```

Start up the built-in PHP web server:

Depending on you environment you need to setup Virtual host or start up the built-in  PHP web server.
```bash
symfony serve
```

Open APi is implemented in the project.

```bash
http://keyword-score.test/api/doc
```


Testing environment is Behat


## Example of usage

JSON API example Path

Usage is very simple.

You only need to pass keyword.

In this example keyword is php:
```bash
http://keyword-score.test/api/v1/score?q=php
```


In response we see score for keyword php.

Response
```bash
{
    "data": {
        "term": "php",
        "score": 6.28
    }
}
```


