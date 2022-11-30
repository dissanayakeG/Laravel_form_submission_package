#####create new folder
```composer init```
#####give details

#####give namespace
```json
 "autoload": {
        "psr-4": {
            "DissanayakeG\\SimpleFormSubmission\\": "src/"
        }
    },
   ``` 
```composer dump-autoload```

#####add src/ in root
#####add serviceProvider class

```php
<?php
namespace DissanayakeG\SimpleFormSubmission;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function boot(){

    }

    public function register(){

    }

}
```
#####main project composer.json
```json
"autoload": {
        "psr-4": {
            "DissanayakeG\\SimpleFormSubmission\\": "packages/formsubmission/src/"
        }
    },
```
#####main project
```composer dump-autoload```

###check package is working
######service provide class
```
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
```
create routes/web.php
Route::get('contact-form', function (){
    return 'Hello';
});

php artisan serve on main app and goto /contact-form

not working
