
# Laravel Test Project  Foundation



## Installation

Clone project ` 
```bash
  git clone https://github.com/Vahagn-99/hhru_foundarium.git
```
Install dependencies `
```bash
  composer update && composer install

  my-project

  cp .env.example .env
 ```
## Configuration
  config .env
   - `DB_DATABASE` =
   - `TEST_DB_DATABASE` = 'test_foundarium'
   - `DB_USERNAME` =
   - `DB_PASSWORD` =

Run Migrations and Seeds `
```bash
  php artisan migrate:fresh --seed
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
