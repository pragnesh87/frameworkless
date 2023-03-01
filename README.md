# Frameworkless / Microservice:

## How Run Application

`clone REPO`

`php -S localhost:8000 -t public`

---

## HTTP Request and Response:

    For HTTP Request and Response we need PSR-7 compliant package.
    - laminas/laminas-diactoros
    - nyholm/psr7 & nyholm/psr7-server

    We need PSR-15 compliant package to handle request and emit response.
    - laminas/laminas-httphandlerrunner
    - middlewares/request-handler

## Router:

    There are several package available for router.
    - nikic/fast-route
    - league/route
    - middlewares/fast-route

## Container:

    PSR-11 Container
    - php-di/php-di
    - league/container

## Authentication:

    Unless our web service will be used exclusively in a private network, then authentication is essential. PSR-15 compliant auth middleware can be found in middlewares/psr15-middlewares, which can be integrated in only a few steps. For our purposes, simple basic authentication is enough, but other concepts, like JWT Tokens, can also be implemented in the same way.

## Database:

    For our example, we are using a classic MySQL database. doctrine/dbal provides a simple, yet powerful abstraction layer. Of course, using another database, such as MongoDB, is also possible. PHP packages exist for every established database, but a PSR for databases does not exist (yet?).

## Logging:

    The PSR-3-compliant package monolog/monolog is almost a standard in its own right. It’s worthwhile to rely on monolog from the start because from logging, to local files, to cloud storage, an adapter is available for every case and is configured with just a few lines of code.

## Tests:

    phpunit/phpunit is a solid choice for Unit Tests. But you can also use other testing tools like Atoum, Codeception, or phpSpec.
