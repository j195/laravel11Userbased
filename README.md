## About Laravel and its versions

1. Laravel Version: 11.0.9
2. PHP Version: 8.2.0
3. MySQL version: 8.0.31

🛠 Laravel 11 Scheduled Task and API Integration
📋 Overview
This Laravel 11 project demonstrates how to:

Schedule a recurring task (every 5 minutes)

Fetch random user data from an external API

Store the data in multiple related tables

Provide a public API for retrieving user information with flexible filtering and field selection

⚙️ Features
Scheduled Task (Every 5 mins): Pulls 5 random users from https://randomuser.me/api/

Database Integration: Stores user info in structured relational tables

Public REST API:

Filter users by gender, city, and country

Specify the number of results

Optional: Select fields to return

Error Handling and 404 Responses

Clean, commented codebase

🧱 Database Structure
users Table
Column Type Description
id int Primary Key
name string Full name
email string Email address
user_details Table
Column Type Description
id int Primary Key
user_id int Foreign Key (users)
gender string Gender (e.g. male/female)
locations Table
Column Type Description
id int Primary Key
user_id int Foreign Key (users)
city string City
country string Country

🔁 Scheduled Task
Command
Custom Artisan command registered via app/Console/Commands/FetchRandomUsers.php

Runs every 5 minutes and:

Calls https://randomuser.me/api/?results=5

Parses name, email, gender, location

Saves data into users, user_details, and locations tables

Scheduler Setup
In App\Console\Kernel.php:

php
$schedule->command('fetch:random-users')->everyFiveMinutes();

To activate the scheduler locally:
bash
php artisan schedule:work

🌐 Public API
Endpoint
bash
Copy
Edit
GET /api/users
Query Parameters
Param Type Description
gender string Filter by gender
city string Filter by city
country string Filter by country
limit int Number of results to return (default 10)
fields string Comma-separated list of fields to include (optional)

Example
/api/users?gender=female&city=London&limit=5&fields=name,email,gender

📤 Response Structure
json
[
{
"name": "Jane Doe",
"email": "jane.doe@example.com",
"gender": "female",
"city": "London",
"country": "United Kingdom"
},
...
]
If no users are found:

json
{
"message": "No users found matching the criteria."
}

🔒 Error Handling
404 response if no data matches

Try-catch blocks around external API

Logs failure gracefully without crashing

## let me give you stepbystep guide here to check the code and tests

1.  first run the command php artisan serve
2.  then in the console write command php artisan fetch:random-users this will add random users in the database from the API call

3.  now open postman and enter the API url http://localhost:8000/api/users

        - this will give you 10 records of users and if you dont pass limit then default 10 records are going to show
          just pass limit=20
        - here are the filters you can use as it was also described the url is
          GET /api/users?gender=male&city=London&fields=name,email,country&limit=10 ---URL
          http://localhost:8000/api/users?limit=20&fields=name,email this will show you only name and email in response
        - http://localhost:8000/api/users?limit=20&fields=name,email,country,city,gender this is the full URL you can work with also

        - the response you can expect from the API request if your request like this GET /api/users/filter?gender=female&city=Paris&fields=name,email,country&limit=2

        [

            {
            "name": "Alice Martin",
            "email": "alice.martin@example.com",
            "country": "France"
            },
            {
            "name": "Lucie Dubois",
            "email": "lucie.dubois@example.com",
            "country": "France"
            }
        ]
