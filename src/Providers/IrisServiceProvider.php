<?php

namespace Jiko\Iris\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Input;

class IrisServiceProvider extends ServiceProvider
{
  protected $hostArray = [];

  public function boot()
  {
    parent::boot();

    $this->hostArray = ['iris.joejiko.com', 'local-iris.joejiko.com'];

    if (in_array(Input::server('HTTP_HOST'), $this->hostArray)) {
      $this->loadViewsFrom(__DIR__ . '/../resources/views', 'iris');
    }
  }

  public function register()
  {

  }

  public function map(Router $router)
  {
    #if (!$this->app->routesAreCached()) {
    require_once(__DIR__ . '/../Http/routes.php');
    #}
  }
}