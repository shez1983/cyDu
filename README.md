## CyDu test Spec

- Use http://adminlte.io/asaframeworkfortheapplicaXon
- Basic Laravel Auth: ability to login as administrator
- Use database seeds to create first user with emailadmin@admin.comand password “password”
- CRUD functionality (Create / Read / Update / Delete) for two menu items: Companies and Employees.
- Companies DB table consists of these fields: Name (required), email, logo (minimum 100x100), website
- Employees DB table consists of these fields: First name (required), last name (required), Company (foreign key to Companies), email, phone
- Use database migrations to create those schemas above
- Store companies’ logos in storage/app/public folder and make them accessible from public
- Use basic Laravel resource controllers with default methods –index,create,store etc.
- Use Laravel’s validation function, using Request classes
- Use Laravel’s pagination for showing Companies/Employees list, 10 entries per page
- Use Laravel make:auth as default Bootstrap-based design theme, but remove ability to
register

## Setup

please run all these from root folder & via terminal.

- run `composer install`
- run `npm install && npm run dev`
- copy .env.example to .env
- run `php artisan key:generate`
- Optional: fill in your database details in the .env 
    - i have defaulted it to sqlite
    - please run `touch database/database.sqlite`
- run (from your root folder)`mv temp.jpg storage/app/public/companies`
    - used for seeding purposes
- run `php artisan migrate --seed`
- run `php artisan serve`

## Tests

run `php artisan test` for a more visually satisfying run of tests or if you are old school run `phpunit`

## Alternatives

i have also created two extra branches - just to show two diff methods (repo pattern & Actions). for a simple app like this probably an overkill but for a more feature intensive I would probably use Actions to keep things dry & reusable.

