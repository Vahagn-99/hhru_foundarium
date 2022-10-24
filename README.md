
# Laravel Test Project Foundarium



## Installation

Clone project ` 
```bash
  git clone https://github.com/Vahagn-99/hhru_foundarium.git
  
  cd hhru_foundarium
```
Install dependencies `
```bash
  composer update && composer install
```
 
## Configuration

```bash
cp .env.example .env
```

  config .env
   - `DB_DATABASE` = 'my_db_name'
   - `TEST_DB_DATABASE` = 'test_foundarium'
   - `DB_USERNAME` = 'my_db_user_name'
   - `DB_PASSWORD` = 'my_db_user_password'

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
