## About Laravel and its versions

1. Laravel Version: 11.0.9
2. PHP Version: 8.2.0
3. MySQL version: 8.0.31

## let me give you stepbystep guide here to check the code and tests

1. first run the command php artisan serve
2. then in the console write command php artisan fetch:random-users this will add random users in the database from the API call

3. now open postman and enter the API url http://localhost:8000/api/users

    - this will give you 10 records of users and if you dont pass limit then default 10 records are going to show
      just pass limit=20
    - here are the filters you can use as it was also described the url is
      GET /api/users?gender=male&city=London&fields=name,email,country&limit=10 ---URL
      http://localhost:8000/api/users?limit=20&fields=name,email this will show you only name and email in response
    - http://localhost:8000/api/users?limit=20&fields=name,email,country,city,gender this is the full URL you can work with also
