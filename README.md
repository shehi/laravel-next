# Laravel - Next.js Monorepo

## Content

1. General Considerations
2. [Backend](./backend/README.md): click to read info related to Backend implementation
3. [Frontend](./frontend/README.md): click to read info related to Frontend implementation

## General Considerations

### Infrastructure

This task is _Docker-based_. `docker-compose.yml` file is the main entrypoint for that.

It consists of _PHP/Laravel based_ [Backend](./backend/README.md), _Typescript/NextJS based_ [Frontend](./frontend/README.md) and _Nginx_ sitting in front.

**To spin up**, run `docker compose up -d`. This starts all 3 containers.

**Logs** of both containers via `docker compose logs` command: e.g. `docker compose logs -f php`. `stdout` and `stderr` is redirected here. _Particularly useful to observe "submit" operation log._

> Before starting containers, it is recommended for Host machine to have `$MYUID` and `$MYGID` env vars, pointint to Host user-id and group-id, respectively. This will make sure internal `php` and `node` accounts have the same IDs as Host user, to avoid permission errors. If not set, default value for both will be set to `1000`.  

**This setup was tested on Linux environment (which is the main production deployment env). Not tested on Mac or Windows.**

### Web Access

Nginx will bind itself to Host's `3000` and `8000` ports. Through these ports, you can access `node` and `php` containers' web interfaces, respectively.

> http://localhost:3000 >>> `node`, i.e. main web interface

> http://localhost:8000 >>> `php`, i.e. PHP backend API (BFF)

### ...

Read on [Backend](./backend/README.md) and [Frontend](./frontend/README.md) readme's now for detailed info.
