## Project overview

Based on [Criteria](docs/project/001-criteria.md) project should be focused on:
- Fast growing API
- RESTful standards and best practice
- Well documented
- **Assumption**:
  - Documentation shows the general project lifecycle rather than all project details
  - ADR: pointed decisions instead of well described decision in full aspect
  - API versioning is omitted
  - No User Stories / Story points / Issue tasks. Issues will be created as a checklist. [ADR](docs/adr/001-issue-and-user-story-are-not-created.md).
  
## Content
 - [Project overview](#project-overview)
 - Project documentation
   - [Criteria](docs/project/001-criteria.md)
   - ADR (as an example for random projects aspects)
     - [Record architecture decisions](docs/adr/000-record-architecture-decisions.md)
     - [User Story & Issue tasks are no created](docs/adr/001-issue-and-user-story-are-not-created.md)
     - [Docker based environment](docs/adr/002-docker-based-enviroment.md)
     - [Laravel PHP framework with Eloquent ORM](docs/adr/003-laravel-framework-with-eloquent-orm.md)
     - [Scribe for API documentation](docs/adr/004-scribe-as-api-documention-handler.md)
     - [Database structure and data](docs/adr/005-db-structure-and-data.md)
     - [Authentication and User Management must be omitted](docs/adr/006-no-authentication-or-user-managment.md)
     - [Use Spatie Query Builder](docs/adr/007-spatie-builder-as-query-builder.md)
   - [ER Diagram](docs/erd/erd_diagram.md)
   - [General API flowchart](docs/flowcharts/000-geenral-flowchart.md)
 - [How to run](#how-to-run)
 - [How to test](#how-to-test)
 - [Project issues](#project-issues)

## How to run
```bash
|----------------------------------------------------------------------
| The first run
|     Initial requirements:
|     - PHP ^8.0
|     - Docker | docker-compose ^1.29
|----------------------------------------------------------------------

// Clone the repository and update .env
git clone https://github.com/mdgithub1/md.git && cd md && cp .env.local .env && composer install

// Pull Docker images
docker pull sdmd/base-nginx-php-fpm8.0-bullseye && docker pull mariadb:10.4

// Run containers
docker-compose -f docker-compose.yml -f docker-compose.local.yml up --build

|----------------------------------------------------------------------
| Start / Stop
|----------------------------------------------------------------------

// Start containers
docker-compose -f docker-compose.yml -f docker-compose.local.yml up

// Stop & remove containers
docker-compose -f docker-compose.yml -f docker-compose.local.yml down

|----------------------------------------------------------------------
| Remove enviroment
|----------------------------------------------------------------------

docker-compose -f docker-compose.yml -f docker-compose.local.yml down --rmi all -v --remove-orphans
```
### Access
- API documentation: [http://localhost:10222/docs](http://localhost:10222/docs)
- API routes: [http://localhost:10222/api/*](http://localhost:10222/api/expenses)
## How to test
```bash
|----------------------------------------------------------------------
| PHPUnit Feature tests (transactional)
|----------------------------------------------------------------------

docker exec -it md-app php artisan test

|----------------------------------------------------------------------
| "Try it out" option in API documentation (non-transactional)
|----------------------------------------------------------------------

@link http://localhost:10222/docs

|----------------------------------------------------------------------
| Postman (or eqvivalent)
|----------------------------------------------------------------------

Follow API documntation
Required headers: Accept: application/json

|----------------------------------------------------------------------
| Rebuild and seed database
|----------------------------------------------------------------------

docker exec -it md-app php artisan migrate:fresh --seed
```

## Project issues
 - [x] New repository
 - [x] Project documentation
   - [x] Project overview
   - [x] Architecture Decision Records
   - [x] EDR
   - [x] General API flowchart
   - [x] Project issues/tasks
   - [x] How to run
   - [x] How to test
 - [x] Project setup
   - [x] Install Laravel with dependencies
   - [x] Docker setup
   - [x] Initial config settings
 - [x] DB modeling
   - [x] Entities with relationships
   - [x] Migrations
   - [x] Seeders / Factories
 - [x] PHPUnit Feature tests (limit volume; just examples)
   - [x] Listing
     - [x] testIndexExistedExpense (200, JSON structure)
   - [x] Read
     - [x] testShowExistedExpense (200, JSON structure)
     - [x] testShowNonExistedExpense (4xx)
   - [x] Create
     - [x] testCreateExpensesWithValidData (2xx)
     - [x] testCreateExpensesWithInvalidData (4xx)
   - [x] Update
     - [x] testUpdateInvalidData (2xx)
     - [x] testUpdateInvalidData (4xx)
   - [x] Delete
     - [x] testDeleteExistedId (200)
     - [x] testDeleteNonExistedId (4xx)
 - [x] Expenses API endpoint for CRUD using API Resources (Eager / no need to use lazy loading for project requirements)
   - [x] API routes
   - [x] Listing _GET_ / _index()_
   - [x] Read _GET_ / _show()_
   - [x] Create _POST_ / _store()_
     - [x] with Laravel FormRequest validation
   - [x] Update _PUT/PATCH_ / _update()_
     - [x] with Laravel FormRequest validation
   - [x] Delete _DELETE_ / _destroy()_
 - [x] Errors handling 
   - [x] Laravel provides default error handling, however, add sample of Handler to provide custom messages/service codes
 - [ ] Flowchart for sample request
