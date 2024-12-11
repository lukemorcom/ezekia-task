# Executives Place

### Setup instructions

Clone the repository, then `cd` into it and run the following to install the dependencies:
``` bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Clone the example .env file and make any required changes
``` bash
cp .env.example .env
```

Migrate and seed the database:
``` bash
./vendor/bin/sail artisan migrate:fresh --seed
```

Run the test suite:
```bash
./vendor/bin/pest
```


### Endpoints
View the API documentation by visiting:
```
{APP_URL}/docs/api
```

Or view the Open API document in JSON format:
```
{APP_URL}/docs/api.json
```
