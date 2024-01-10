# for-garuda-cyber 
The whole root directory is the answer to #2. The rest is in [answers/](answers/).

## Installation
Create a database, copy the ```.env.example``` file and rename it to ```.env```, edit the ```.env``` file to match your environment configuration, then execute 
```bash
composer update && npm install && npm run build && php artisan migrate:fresh --seed && php artisan key:generate && php artisan storage:link
```
## Usage
Execute
```bash
php artisan serve
```
and visit http://localhost:8000 (or whichever port ```artisan``` serves on) on your browser.
