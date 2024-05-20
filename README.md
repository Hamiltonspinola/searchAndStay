<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://assets.searchandstay.com/midias/60a34d82cc193.png" width="400" alt="Laravel Logo"></a></p>
# Bookstore Project

This is a sample project demonstrating a bookstore system using Laravel.

## Overview

The project consists of a Laravel application that provides RESTful APIs for managing books and their association with stores.

## Features

-   [x] Create a new book
-   [x] Update book information
-   [x] Delete a book
-   [x] Associate a book with one or more stores
-   [x] Disassociate a book from one or more stores
-----------------------------------------------------
-   [x] Create a new store
-   [x] Update store information
-   [x] Delete a store

## Technologies Used

-   Laravel: version 10.3.3
-   MySQL: version 10.4
-   PHPUnit: version 1.0

## Prerequisites

-   PHP >= 8
-   Composer
-   MySQL

## Installation

1. Clone the repository:

 <p><a href='https://github.com/Hamiltonspinola/searchAndStay.git'>repository</a></p>

2. Install or update dependencies:

 <p>Composer update</p>

3. Copy the `.env.example` file to `.env`:

4. Configure the `.env` file with your database credentials.

5. Generate the application key:
 <p>php artisan key:generate</p>

6. Run the database migrations:
 <p>php artisan migrate</p>

## Running the Development Server

To start the development server, run the following command:

 <p>php artisan migrate</p>

## Using the REST API
# Authentication credentials#
POST /api/login
header{
    Content-Type: "application/json"
    Accept: "application/json"
}

body{
    "email": "searchandstay@email.com",
    "password": "password"
}
<p>Copy the token obtained from the 'token' index of the data object</p>

--------------------------------------------------------------
header{
    Content-Type: "application/json"
    Accept: "application/json"
    Authorization: "Bearer"
}



### Create a new book

POST /api/books

{
"name": "Book Name",
"isbn": 1234567890,
"value": 20.50
}


### Update book information

PUT /api/books/{id}

{
"name": "New Book Name",
"isbn": 0987654321,
"value": 25.00
}

### Delete a book

DELETE /api/books/{id}

### Associate a book with one or more stores

POST /api/books/{id}/attach-stores

{
"store_ids": [1, 2, 3]
}

### Disassociate a book from one or more stores

POST /api/books/{id}/detach-stores

{
"store_ids": [1, 2]
}

## ------------------------------------------------------- ##
### Create a new store

POST /api/stores

{
"name": "Store Name",
"address": "Street 1",
"active": true
}


### Update store information

PUT /api/stores/{id}

{
"name": "New Store Name",
"address": "New address",
"active": false
}

### Delete a store

DELETE /api/stores/{id}

## Running Tests

To run the tests, execute the following command:

php artisan test
