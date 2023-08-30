# Backend

## Infrastructure

* _Laravel_ on top of **PHP 8.2** _Dockerized_: PHP-FPM exposed on port `9000` of `php` container.
* _Composer_ pre-installed.
* Unprivileged user `php`, with `sudo` powers provided.
* `stdout` and `stderr` output is redirected to both container logs and `backend/storage/logs/laravel.log` file. Container logs can be watched through: `docker compose logs -f php`.
* Read [Main README file](../README.md) regarding:
  * how to spin up the containers,
  * how to provide `$MYUID` and `$MYGID` env vars in order to avoid permission issues.

## Usage

1. Once containers are spun up, enter `php` terminal via: `docker compose exec php bash -l`.
2. `cd backend`
3. `composer install`
4. To run tests: `./artisan test`:
    * 2x tests, for `CardService` and `CardsController`. _Unit_ and _Feature_ tests, respectively.

## Design Considerations

1. `CardsController` serves as a _port_ to Web **infrastructure**:
   * `index()` for `GET`: 
     * fetches data
     * handles sorting
   * `store()` for `POST`: since we don't have data-source, `PUT` wasn't a viable option here:
     * Handles "submit" feature: logs incoming data back into `stdout` and return as a response.
2. `CardService` serves as a _domain_ component. Unfortunately we lack _entities_ necessary for Domain:
   * Utilizes `CardRepository` to fetch remote data. 
3. `CardRepository` serves as a _application_ component, practically functioning as an API _adapter_, serving `CardService` with main data.
4. `AppServiceProvider` registers both `CardService` and `CardRepository` to service container for DI. Necessary interfaces/contracts wherever applicable.
5. `RouteServiceProvider` handles routing:
   * `routes/api.php` routes API endpoints - only has `/api/cards` resource (`GET` and `POST` only)
   * `routes/web.php` takes care of Web middleware (almost non-existent).
6. `CardsRequest` handles input validation for both `GET` and `POST` requests sent to `/api/cards` endpoint:
   * `GET` requests: sorting order input is validated.
   * `POST` requests: submit operation input is validated. Since we don't have local data-source, `PUT` wasn't a viable option.
7. `Enums\Sort` enum contains options valid for sort order.
8. Across PHP, `declare(strict_types=1);` was used for stricter type enforcement.
