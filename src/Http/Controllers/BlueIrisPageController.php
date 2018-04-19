<?php

namespace Jiko\Home\Http\Controllers;

use Jiko\Http\Controllers\Controller as BaseController;

class BlueIrisPageController extends BaseController
{
  public function setup()
  {
    $this->setContent('home::setup');
  }

  public function console()
  {
    view()->share('config', ['app.class' => 'no-branding', 'main.class' => 'no-menu no-sidebar']);
    $this->setContent('home::console', ['data' => request()->user()->blueiris->connection]);
  }
}