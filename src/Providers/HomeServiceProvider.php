<?php

namespace Jiko\Home\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
  protected $hostArray = [];

  public function boot()
  {
    parent::boot();

    if ($this->app->runningInConsole()) {
      $this->commands([

      ]);
    }
//    $this->hostArray = ['iris.joejiko.com', 'local-iris.joejiko.com'];
//    if (in_array(Input::server('HTTP_HOST'), $this->hostArray)) {
//    }
    view()->addNamespace('home', __DIR__ . '/../resources/views');
  }

  public function register()
  {
    $this->app->register('Jiko\Home\Providers\RouteServiceProvider');
  }
}