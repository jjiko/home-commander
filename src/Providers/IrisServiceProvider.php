<?php

namespace Jiko\Iris\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class IrisServiceProvider extends ServiceProvider
{
  protected $hostArray = [];

  public function boot()
  {
    parent::boot();

//    $this->hostArray = ['iris.joejiko.com', 'local-iris.joejiko.com'];
//    if (in_array(Input::server('HTTP_HOST'), $this->hostArray)) {
//    }
    view()->addNamespace('iris', __DIR__ . '/../resources/views');
  }

  public function register()
  {
    $this->app->register('Jiko\Iris\Providers\RouteServiceProvider');
  }
}