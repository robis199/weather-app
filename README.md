# Weather-App
 Simple weather forecast app built with Symphony 

**Requirements**   

PHP 7.4 or higher  
Symfony 5.4.0 or higher
PostgreSQL 14.1 or higher
Composer   

Installation
Run following commands:

- git clone git@github.com:robis199/weather-app.git

- cd Weather-App\weather-app

- composer install

**Setup and Usage**

Database url needs to be placed in .env file in case you are using Dbal, otherwise choose an appropriate driver. 

API keys for retrieving data are available at ipstack.com and openweathermap.org.

Store your keys as ENV variables in the .env file.

Also, configure a real IP address in the same place since the local server has a default address which won't return anything.




- access the application in your browser at the given URL (https://localhost:8000 by default).













NOTE: free plan for ipstack.com API does not support HTTPS connections.
