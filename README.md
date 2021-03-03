# Breeze Todo

Breeze todo is a simple "Todo" App built using

- Laravel Breeze
- Inertia JS
- Vue JS
- Tailwind CSS
- phpunit 
- chart.js 
 
 It serves as both a portfolio piece and a learning tool for anyone struggling with the basics of laravel. 

## Installation
It was built using Laravel Valet with a mysql backend so you shouldn't have much trouble running it anywhere.

Installs the same as any Laravel app 
- Composer Instal
- php artisan migrate:fresh --seed
- npm i 
- npm run dev

When seeding the database a sample user is created for you 
User: a@b.com
Pass: password

But you can also just register a new account if you really wanted to. 


## Application Layout 

### Controllers
The application has two main controllers 

DashboardController: Used to generate the main dashboard page
    - Dashboard controller is a simple dashboard that shows a graph of your weekly completed Todos. 

TodoController: 
    - Used for manipulating App\Models\Todo models via the web interface. 
    
### Testing 
Tests can be found in the tests directory. There are Unit and Feature tests that cover the entirety of the (very limited)
scope of this application.     
