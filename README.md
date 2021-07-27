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
        endpoint : localhost:8000/api/login <br/>
         
       
            
             request payload : {
                "email":"admin@example.com",
                "password":"admin123"
            }
         
