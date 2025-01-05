# simple-php-api-webnode

This application demonstrates a simple REST API for managing orders. The solution focuses on providing clean code architecture, testability, and flexibility. It is containerized using Docker with a MySQL database for data storage.

## Requirements
- Docker Compose

## Run App

### Installation
Clone the repository:
```
git clone <repo-url>
cd <repo-directory>
```

### Start App with Docker Compose:
```
docker-compose up --build
```

### Access the API:
`http://localhost:8000/order/{id}`

## Run Tests
```
docker compose run --build --rm app ./vendor/bin/phpunit tests --testdox
```

## Tech Stack

- PHP 8.1 with Slim Framework 4
- Database: MySQL (with Dockerized setup)
- ORM: Doctrine for database operations
- DI container
- PHP dotenv
