## Website Setup

#### Create Blank Database 

------------
#### Website Configuration

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

#### Admin login credentials
* http://localhost:8000/admin
* email : admin@gmail.com
* password : admin@123


####  Implementation
* The complete project structure follows Laravel's MVC conventions.
* For CRUD operations, a resource route is used.
* For data visualization, the JavaScript charting library Chart.js is used.
* For bulk data upload and export, Maatwebsite/Laravel-Excel package is used.
* For data tables, the Yajra/Laravel-datatables-oracle package is used.
* For location information with an IP address, the Steve Bauman/location package is used.
