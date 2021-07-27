<h1>Development process</h1>


<h3>Setup development environment</h3>
============================================
<br/>
1.Install and setup PHP, MYSQL and Apache server
    <p><br/>
  -For Window Install Xampp follow link https://www.apachefriends.org/download.html
  <br/>
  -For linux :<br/>
      sudo apt install apache2 (for apache server)<br/>
      sudo apt install mysql-server (for mysql server)<br/>
      sudo mysql_secure_installation (for setting up credentials and configuration)<br/>
      sudo apt install php libapache2-mod-php php-mbstring php-xmlrpc php-soap php-gd php-xml php-cli php-zip php-bcmath php-tokenizer php-json php-pear php-mysql php-gettext php-curl php-memcached php-xdebug php-intl php-fpm php-pgsql php-imap
  </p>

2.Install and setup composer:
  <p>Composer is dependency manager for php based application</p>
  <p>You can download the composer via https://getcomposer.org/download/</p>
  
  
3.Install and setup laravel:
  <p>Laravel is php framework that supports web based application. laravel is powerful framework, it follows singleton pattern with MVC based architecture. laravel also support prominent feature Eloquent. it is a ORM(object-relation-mapping) where models are mapped to the database table. for more info visit :https://laravel.com/</p>
 <br/>
   we can set up laravel via composer command:<br/> - composer create-project laravel/laravel example-app <br/> or <br/> -curl -s "https://laravel.build/example-app" | bash

<br/>
<h3>Implementation</h3>
=============================== <br/>
<p>As we know Laravel can be used as API server. There is api folder structure in laravel for residing all your api based controller.</p> 
1. Created api controller <b>DayWeekFinderController</b><br/><br/>
    -"php artisan make:controller DayWeekFinderController --api" (php artisan is laravel based cli command line)<br/>
    -moved the create controller to Http/Controllers/Api/<br/><br/>
2. Created the method <b>dayWeekFinder</b> in controller.<br/>
   - This method takes the http request and return json response. <br/>
   - This method takes fromdate (datetime format), todate (datetime format) and timezone (for eg:Australia/Sydney) request parameter.<br/>
   - This method response the number of days and number of weeks in between fromdate and todate.<br/>
   - This method use laravel <b>Validator</b> to validate input parameter.<br/>
   - This method use third party <b>Carbon</b> plugin to calculate the number of week and days. Carbon help to quickly play around the date related calculation. it utilize PHP DateTime class.<br/><br/>
3. Created laravel authentication using <b>laravel passport</b>:
    - install laravel passport (composer require laravel/passport).<br/>
    - "php artisan migrate" (this will create table in database for setting up authentication tables).<br/>
    - "php artisan passport:install" (This command will create the encryption keys needed to generate secure access tokens).<br/>
    - Then need to add "use HasApiTokens" trait in user model.<br/>
    - Next add "Passport::routes()" in AuthServiceProvider class. <br/><br/>
    for more information visit : https://laravel.com/docs/8.x/passport <br/><br/>
    
    
4. Created the <b>login</b> function in UserController to get <b>accessToken</b>. we need to provide this accessToken when calling dateweekfinder api.<br/>
    - It takes email and password for authentication and return accessToken in response. <br/><br/>

5. Created the rest api endpoint under routes/api.php <br/>
    - "/day-week-finder" is a get http request that is mapped to <b>dayWeekFinder</b> function of <b>DayWeekFinderController.</b> auth:api middleware is used, so that only authenticated users can make a request for this api. <br/>
    - "/login" is a post http request that is mapped to <b>login</b> function of <b>UserController.</b> <br/> <br/>
 
 <h3>Run the application</h3>
=============================== <br/>
    - Clone this repo using "git clone https://github.com/biuprety/MyGreenButler.git".<br/><br/>
    - Go to project root directory and enter "composer install" command. it will install all of your dependencies. <br/><br/>
    - Create a database named "myGreenButler". Database configuration is set in .env file in root directory. <br/><br/>
    - Enter command "php artisan migrate". it will create all the tables from migration files required for user and laravel passport. <br/><br/>
    - Enter command "php artisan db:seed". it will seed the user(name:'admin', email:'admin@example.com', password:'admin123') to user table from UserSeeder class.<br/><br/>
    - Start apache2 web server.<br/><br/>
    - Start the application server using "php artisan serve" command.<br/><br/>
     <h5>Run the API</h5>
     - First authenticate and get accessToken <br/>
        Endpoint : localhost:8000/api/login <br/>
        Request payload :
     
              {
                "email":"admin@example.com",
                "password":"admin123"
            }
         


Response :
            
             {
    "user": {
        "id": 1,
        "name": "admin",
        "email": "admin@example.com",
        "email_verified_at": null,
        "created_at": "2021-07-27T07:16:50.000000Z",
        "updated_at": "2021-07-27T07:16:50.000000Z"
    },
    "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDYyOWExNzU4M2FjNThkNzY4OTQwYTZlYTUzN2VkNWM3MDcxZDJiODgxNGQ2OWU0ZDc1ZTdhZjUzNmIzZTc4ZmI5MGFhNTVlNWQzN2I5MmIiLCJpYXQiOjE2MjczNzA0NzIuNTIwMjE5LCJuYmYiOjE2MjczNzA0NzIuNTIwMjIzLCJleHAiOjE2NTg5MDY0NzIuNTA5NTM1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.lXESQ1CY1vQByvxt38kNfGxoFrALgYVDLtTGTrL0ApbePJxv3Ms-YkDxy8cfKPDEjaPARZANXHzzU-hzK0JC4a5svLujMLIn1PM8hSPSywF6Q1DDk77qaMDPIZBiYgOyB8ootDAIWp98IyrJQ8OlO6AqNOQehwUvlz7qldGJKneZLhbCVglrDHji6x_CAc3WV0rHRMgZ22JmfdQHg-vCS2zhg2Uh88kZXDSwPmL8ZnH_lkGxmBmOQE2acwi8O_JwMWQtF2VRBgXpFv37ZiJbatuwYUKwGgpFDQPyYtf3pkC56GnqIU-f3GyQH5jJMwvkSyPOvHZCGV1FB0Xmy2avLWXMLljibd63AvY8F5O5xUnYEblpRhvuJoC1d4zD4LGcciiofT-1wIOUNFXry1ivSqGh2KWaNmOTuLWHk1HKtNxVlH-h3tcvK3bVSoaLDCKChrOJp8YmnXRjkRWr7KRUtMPXlnsDsKMB4Hw9Tsh4vWK2yyEXtMDb6WxTd99_KVSEuaf4OGdIpJ9LH-FdUL-hZLdx4xw92tnPR7SWzt0OHFODgywI33iF3zkcXSQLmAOBZDtwnFF_Oc5AqdGRYAPRO2RHzDYtD9xcNrNcoKc7l6giWX1AAf7IBx1mhVCa5n2P0ALZr8n05ogdR1XGl8B_YLxr2FwOyc94FZ-b7KKSXSU"
}
