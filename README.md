Tracksale
=======

This is a small POC for Software Engineer test at Tracksale.

This project was made using PHP as programming language with Symfony 4.1 as framework and using DDD, TDD and SOLID concepts.

Pre-requisites
------  

For run this project, you must have `docker` and `docker-compose` installed.

Run
------  

* Clone this repo
* Execute `docker-composer up`
* Open `http://localhost:4000/api/` in your browser.
* If you see timestamp on browser, is working.

Routes
------

##### GET /api/customers/{customerDocument}

Check if customer can be impacted.

Request example
```bash
curl --request GET --url http://0.0.0.0:4000/api/customers/53216823644
```

Success response example.
```json
{
    "id": 1,
    "customerDocument": "12345678900",
    "dateImpactStart": "2018-10-05",
    "dateImpactEnd": "2019-01-03",
    "allowImpact": true,
    "createdAt": "2018-10-05 18:14:27",
    "updatedAt": null
}
```

##### DELETE /api/customers/{customerDocument}

Remove customer from impact rules.

Request example
```bash
curl --request DELETE --url http://0.0.0.0:4000/api/customers/53216823644
```

Success response example.
```json
{
    "removed": true
}
```

Unit Tests
------  
* Clone this repo
* Execute `docker-composer up`
* Execute `docker exec -it tracksale_tracksale-test-symfony-php-fpm_1 php /var/www/html/composer.phar run tests`

Reference
------ 
* https://secure.php.net/
* https://symfony.com/
* https://www.docker.com/