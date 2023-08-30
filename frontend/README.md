# Frontend

## Infrastructure

* _NextJS 13_ (with React 18) on top of **Typescript 5.1** _Dockerized_: NextJS server exposed on port `3000` of `node` container. Upstreamed to `nginx` at port `3000`.
* Latest Node LTS with Cypress pre-installed.
* Unprivileged user `node`, with `sudo` powers provided.
* Read [Main README file](../README.md) regarding:
    * how to spin up the containers,
    * how to provide `$MYUID` and `$MYGID` env vars in order to avoid permission issues.

## Usage

> Please start DEV env before tests

1. Once containers are spun up, enter `node` terminal via: `docker compose exec node bash -l`.
2. `cd frontend`
3. `npm i`
4. Build for PROD: `npm run build`
5. Start PROD build: `npm start`
    * Access: http://localhost:3000 
6. Start DEV env: `npm run dev`
    * Access: http://localhost:3000
7. To open Cypress: `cypress open`
8. To run tests: `cypress run`
    * Single Cypress E2E test provided.

## Design Considerations

* **Typescript** and only!
* **Modular folder structure** lies within `src/` folder.
* **Data Loading**:
  * Since data is quite simple, by default it loads during SSG (server-side generation). I included `src/hooks/useHasMounted` hook which can be used to force client-side data loading.
  * All data-loadings are performed through `SWR` lib, asynchronously with suspense enabled. Extremely simple `Suspense` was implemented to wait for the data to load and `List` component to be ready.
  * Data comes from Backend in JSON format.
  * Since data has no unique Identifier, I used `realName` field as one.
* **Object Model (CardObject)** in typed within `src/schema/card.ts` and used across source code, wherever applicable. _Come think of it:_ **maybe CardObject is a bad naming, maybe it should be PlayerObject**. :)
* `CardsContext` to track card sorting and active/selected card.
* **Views** are implemented as requested:
  * via _TailwindCSS_ that comes with NextJS (tho not my first preference, I prefer Bootstrap via SCSS).
  * **Grid-based layout**, 4x2 grid-ing.
  * Semantic Markup, as much as possible.
  * **No custom (S)CSS** but if necessary, can easily be implemented via `Module-SCSS` support of NextJS (can demonstrate during an interview).
  * **UX** as much as possible: button disabled whenever clicking them is not appropriate (during loading, or data missing etc)
  * **Layout Shift** was minimized as much as possible, via grid layout.
