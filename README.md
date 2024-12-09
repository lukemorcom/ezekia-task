# Executives Place

### Setup instructions

Clone the repository, then `cd` into it and run the following
``` bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Migrate and seed the database
``` bash
./vendor/bin/sail artisan migrate:fresh --seed
```
