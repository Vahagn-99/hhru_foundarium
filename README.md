
# Laravel Test Project  Foundarium



## Installation

clone project
```bash
  composer update && composer install

  my-project

  cp .env.example .env
 ```
  config .env
   - `DB_DATABASE` =
   - `TEST_DB_DATABASE` = 'test_foundarium'
   - `DB_USERNAME` =
   - `DB_PASSWORD` =
```bash
  php artisan migrate
```

Run test ` 
  - create test database named test_foundarium
 ```bash
    php artisan test
 ```

Api documentation
```http
 /api/documentation
```
