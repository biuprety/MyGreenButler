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
===============================
1. Create api controller <b>DayWeekFinderController</b><br/>
    -php artisan make:controller DayWeekFinderController --api
