## Website Setup

#### Create Blank Database 

------------
#### Website Configuration

### check version
Application Name : Laravel  
Laravel Version : 10.47.0
PHP Version : 8.1.0
Composer Version : 2.5.5

Create new .env file at root folder same with same content of .env.example file.
Need to change following things at .env file as per our requirement [/.env](../master/.env) :

| Configuration Name | Description  |
|--|--|
| APP_NAME | Application Name |  
| APP_ENV | environment of your application |
| APP_URL | Application URL |  
| DB_HOST | Database host name | 
| DB_DATABASE | Database name |
| DB_USERNAME | Database user name | 
| DB_PASSWORD | Database password |  


#### Run following commands for install required library 
* Note: before running following commands delete composer.lock file if exist.
* composer install 
* php artisan key:generate
* php artisan migrate
* php artisan db:seed

#### 
* http://localhost:8000/

