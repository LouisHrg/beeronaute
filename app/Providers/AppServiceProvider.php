<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \Form::component('bsText', 'form.text', ['name', 'displayname', 'placeholder'=>null,'value'=> null, 'attributes' =>[], 'helper'=> null ]);

        \Form::component('bsEmail', 'form.email', ['name', 'displayname', 'placeholder'=>null,'value'=> null, 'attributes' =>[], 'helper'=> null ]);

        \Form::component('slug', 'form.slug', ['name', 'displayname', 'placeholder'=>null,'value'=> null, 'attributes' =>[], 'helper'=> null ]);

        \Form::component('trumbo', 'form.trumbo', ['name', 'displayname', 'value'=> null, 'attributes' =>[], 'helper'=> null ]);
        
        \Form::component('bsSubmit', 'form.submit', ['name', 'helper'=>null]);

        \Form::component('bsFile', 'form.fileupload', ['name', 'placeholder','action']);

        \Form::component('bsDate', 'form.datetimepicker', ['name', 'value','displayname','placeholder' => null]);

        \Form::component('bsSelect', 'form.select', ['name', 'data','value','displayname','placeholder' => null]);

        \Form::component('bsPasswordConf', 'form.passwordconf', ['name', 'displayname','placeholder' => null,'placeholder2' => null]);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        }
    }
}
