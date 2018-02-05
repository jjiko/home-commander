<?php namespace Jiko\Iris\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
  protected $namespace = 'Jiko\Iris\Http\Controllers';

  public function map(Router $router)
  {
    $router->group(['namespace' => $this->namespace], function () {
      require_once(__DIR__ . '/../Http/routes.php');
    });
  }
}