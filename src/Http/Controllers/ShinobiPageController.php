<?php

namespace Jiko\Home\Http\Controllers;

use Jiko\Http\Controllers\Controller as BaseController;

class ShinobiPageController extends BaseController
{
  public function console()
  {
    view()->share('config', ['app.class' => 'no-branding', 'main.class' => 'no-menu no-sidebar']);
    $this->setContent('home::shinobi.console');
  }
}