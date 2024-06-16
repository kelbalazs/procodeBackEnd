# Simple Cat Management System

This project is a Simple Cat Management System that allows you to manage information about cats using a Laravel-based back-end and a MySQL database. The project includes database migrations for creating the cats table and two API endpoints: one for adding a new cat and another for retrieving the list of all cats.

## Technologies Used

- Framework: Laravel
- Database: MySQL

## Project Setup

### Installation
Clone the repository:

git clone https://github.com/your-repo/cat-management.git

cd cat-management

Install dependencies:

composer install

Set up environment configuration:

Copy the .env.example file to .env and configure your database connection details:

cp .env.example .env

Edit the .env file to match your MySQL configuration:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=cat_management

DB_USERNAME=your_username

DB_PASSWORD=your_password

Generate the application key:

php artisan key:generate

Run the database migrations:

php artisan migrate

### Running the Application
Start the Laravel development server:

php artisan serve

The application will be accessible at http://127.0.0.1:8000.
There is also a simple front end page is available to see and test the backend.

### API Endpoints
Retrieve All Cats
Endpoint URL: /api/cats
HTTP Method: GET
Request Parameters: None
Response Format:
json

    {
        "id": 1,
        "name": "Whiskers",
        "dob": "2020-06-15",
        "owner_name": "John Doe"
    },
    {
        "id": 2,
        "name": "Mittens",
        "dob": "2019-08-21",
        "owner_name": "Jane Smith"
    }
    // More cat objects...
]Response Codes:
200 OK: The request was successful and the list of cats is returned.
500 Internal Server Error: An error occurred on the server while processing the request.
Add a New Cat
Endpoint URL: /api/cats

HTTP Method: POST

Request Parameters:

Content-Type: application/json

json

{
    "name": "Whiskers",
    "dob": "2020-06-15",
    "owner_name": "John Doe"
}
Fields:
name: (string, required) The name of the cat.
dob: (date, required) The date of birth of the cat.
owner_name: (string, required) The name of the owner of the cat.
Response Format:

json

{
    "message": "Cat added successfully",
    "cat": {
        "id": 1,
        "name": "Whiskers",
        "dob": "2020-06-15",
        "owner_name": "John Doe",
        "created_at": "2023-06-16T12:34:56.000000Z",
        "updated_at": "2023-06-16T12:34:56.000000Z"
    }
}
Response Codes:

201 Created: The cat was successfully added to the database.
400 Bad Request: The request data is invalid.
500 Internal Server Error: An error occurred on the server while processing the request.
Error Responses
For both endpoints, errors are returned in the following format:

json

{
    "error": "Error message"
}
Example Error Response for Invalid Data (HTTP 400):
json

{
    "error": {
        "name": [
            "The name field is required."
        ],
        "dob": [
            "The dob field is required."
        ],
        "owner_name": [
            "The owner name field is required."
        ]
    }
}

### Testing the API
You can use tools like Postman or cURL to test the API endpoints.

Retrieve All Cats:
curl -X GET http://127.0.0.1:8000/api/cats

Add a New Cat:
curl -X POST http://127.0.0.1:8000/api/cats -H "Content-Type: application/json" -d '{"name": "Whiskers", "dob": "2020-06-15", "owner_name": "John Doe"}'

### Conclusion
This Simple Cat Management System provides basic functionality for managing cat information with a Laravel back-end and a MySQL database. The API endpoints allow for retrieving and adding cats, with proper error handling and validation.
