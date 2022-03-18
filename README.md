# REST API for portfolio and CV
A REST API built with PHP and Laravel as part of a headless CMS for my personal portfolio and CV. This is part of a school assignment where I'm learning how to build a REST API with PHP and consume it with JavaScript/TypeScript. 

## The API
The API has been developed with authentication using Laravel and Laravel Sanctum. A few routes are public for logging in and reading data. The routes for logging out and modifying data are protected.

### Development server and database
To server the development server use the command `php artisan serve` and to migrate the database tables use the command `php artisan migrate`. The database connection is set using a `.env`-file. Set your database information in `.env.example` and rename the file to `.env`. The migrations can be found in `database/migrations`.

### Files and structure

#### Endpoints and routes

Routes are set in `routes/api.php` using methods from different controllers. Some routes are protected using Laravel sanctum and some are public.

**Public endpoints**

| Method | Path                        | Description                      |
| ------ | --------------------------- | -------------------------------- |
| POST   | ./api/login                 | Log in user in API               |
| GET    | ./api/projects              | Get all projects                 |
| GET    | ./api/skills                | Get all skills                   |
| GET    | ./api/work-experiences      | Get all work experiences         |
| GET    | ./api/education             | Get all programs/courses         |

**Protected endpoints**

| Method | Path                        | Description                      |
| ------ | --------------------------- | -------------------------------- |
| POST   | ./api/logout                | Log out user from API            |
| POST   | ./api/projects              | Create one project               |
| PUT    | ./api/projects/{id}         | Update one project by id         |
| DELETE | ./api/projects/{id}         | Delete one project by id         |
| POST   | ./api/skills                | Create one skill                 |
| PUT    | ./api/skills/{id}           | Update one skill by id           |
| DELETE | ./api/skills/{id}           | Delete one skill by id           |
| POST   | ./api/work-experiences      | Create one work experience       |
| PUT    | ./api/work-experiences/{id} | Update one work experience by id |
| DELETE | ./api/work-experiences/{id} | Delete one work experience by id |
| POST   | ./api/education             | Create one program/course        |
| PUT    | ./api/education/{id}        | Update one program/course by id  |
| DELETE | ./api/education/{id}        | Delete one program/course by id  |

#### Models

There are a model for each object that connects to the database and can be found in `app/Models/`.

#### Controllers

Each object has a controller that handles all the CRUD functionality connected to the models. The controllers handles all validation and can be found in `app/Http/Controllers`

## Project with three parts

This API is part of a school assignment that has been developed in three separate parts. One REST API, one admin website with login to administrate it and a public website to read data from it.

These repositories holds the rest of the project:

- Admin website: https://github.com/sofiewallin/cv-admin
- Public website: https://github.com/sofiewallin/cv-application