# Laravel 10 Paasport API Authentication
* Install passport ```composer require laravel/passport```
* Troubling issue to fix intalling passport ```issue line```
```
./composer.json has been updated
> php artisan clear-compiled
Loading composer repositories with package information
Updating dependencies (including require-dev)
Your requirements could not be resolved to an installable set of packages.
```

### Solved issue 
* Adding this line ```"laravel/passport": "^11.8"``` on composer.json file under ```require```
* composer update
### Passport Configuration 
* Migrate ```php artisan migrate```
* Passport install ```php artisan passport:install```
![alt text](image.png)

* Insure those line on user model
```
use HasApiTokens, HasFactory, Notifiable;
```
* Go to ```config/auth.php``` and below code
```
  'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
```
* Configure route, and UserController and UserModel
* Set Migration and seeder
* create seeder for user sedding depending migration table column name

* Import classs
 ```
use DB;
use Carbon\Carbon;
  ```
```
   public function run(): void
    {
        DB::table('users')->insert(

            [
                    'name' => 'Admin User',
                    'email' => 'admin@gmail.com',
                    'usertype' => 'admin',
                    'password'=>bcrypt(123456),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
            ]
        );
    }
```
* php artisan db:seed --classs=className
* Replace Sanctum by ```use Laravel\Passport\HasApiTokens``` on user model

