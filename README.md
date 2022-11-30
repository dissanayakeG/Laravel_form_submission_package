#####create new folder
```composer init```
give details

#####add namespace
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

#####check package is working
######service provide class
```
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
```
#####create routes/web.php
```
    Route::get('contact-form', function (){
        return 'Hello';
    });
```

#####php artisan serve on main app and goto /contact-form

not working

#####in main app/config/app.php add to providers
```
\DissanayakeG\SimpleFormSubmission\FormServiceProvider::class

composer dump-autoload
```

now working

#####create src/views/form.blade.php
add this into boot method in service provider, then it will load the views
```
$this->loadViewsFrom(__DIR__ . '/views', 'formsubmission');
```

######update web.php as
```
    Route::get('contact-form', function (){
        return view('formsubmission::form');
    });
formsubmission is package name
```

######blade file form like
```<form action="{{route('contact-form')}}" method="post">```

######web.php
```
    Route::get('contact-form', function (){
        return view('formsubmission::form');
    })->name('contact-form');

    Route::post('contact-form', function (\Illuminate\Http\Request $request){
        return $request->all();
    });
```
now you can see the request data on browser when submitting the form

#####create src/Http/Controllers/FormController.php
```
    class FormController extends Controller
    {
        public function index(){
            return view('formsubmission::form');
        }
    
        public function send(Request $request){
            return $request->all();
        }
    }
```

######update web.php
```
    use DissanayakeG\SimpleFormSubmission\Http\Controllers\FormController;
    
    Route::get('contact-form',[FormController::class, 'index'])->name('contact-form');
    Route::post('contact-form',[FormController::class, 'send']);
```

add src/database/migrations
add src/Models

make Model and migration

php artisan make:model Contact -m

move them into package and change namespace

migration like
 
``` 
    public function up()
     {
         Schema::create('contacts', function (Blueprint $table) {
             $table->id();
             $table->text('message');
             $table->string('email');
             $table->string('name');
             $table->timestamps();
         });
     }
```

create database and update env in main project

php artisan migrate not execute the migrations inside the package

so need to register them

add this in service provider boot method
```
   $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
```
now php artisan migrate execute the migrations inside the package

######update model

```
    protected $guarded = [];
```

######update controller method 

```
    public function send(Request $request)
        {
            Contact::create($request->all());
            return redirect(route('contact-form'));
        }
```

#####merge configs

#####add /src/config/contact.php

```php
    
    return [
        'send_email_to'=>'hello@gmail.com'
    ];
```


add this in service provider boot method
```
    $this->mergeConfigFrom(__DIR__ . '/config/contact.php','formsubmission');
```

#####sending emails

#####php artisan  make:mail ContactMailable --markdown=contactform.email

and move the App\Mail folder into package src

and move resources\views\contact folder into package src\views 

######update controller method
```
    public function send(Request $request)
    {
        Contact::create($request->all());
        Mail::to(config('formsubmission.send_email_to'))->send(new ContactMailable($request->message));
        return redirect(route('contact-form'));
    }
    
    formsubmission is package name
```

######update ContactMailable
```
    protected $message;
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    public function build()
        {
            return $this->markdown('formsubmission::contactform.email')->with(['message'=>$this->message]);
        }
formsubmission is package name
```

######update env with mailtrap.io details


#####publishing vendor, so users can use this config file in there projects app/config/fileName.php
this will copy 
formsubmission/src/config/contact.php into user application config/contact.php


######in service provider boot method add
```
    $this->publishes([
            __DIR__.'/config/contact.php' => config_path('contact.php'),
     ]);
```
        
#####run in main project
php artisan vendor:publish


