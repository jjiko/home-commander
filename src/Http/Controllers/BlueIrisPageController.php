<?php

namespace Jiko\Home\Http\Controllers;

use Jiko\Home\Models\Home;
use Jiko\Http\Controllers\Controller as BaseController;

class BlueIrisPageController extends BaseController
{
  public function setup()
  {
    $this->setContent('home::setup');
  }

  public function map()
  {
    $nestUser = auth()->user()->nest;
    $blueirisUser = auth()->user()->blueiris;

    if (!$nestUser || !$blueirisUser) {
      return redirect()->route('home::console');
    }

    view()->share('config', ['app.class' => 'no-branding', 'main.class' => 'no-menu no-sidebar']);

    $this->setContent('home::map-to-nest', [
      'nest' => $nestUser->data,
      'blueiris' => $blueirisUser->connection
    ]);
  }

  public function console()
  {
    view()->share('config', ['app.class' => 'no-branding', 'main.class' => 'no-menu no-sidebar']);
    $this->setContent('home::console', ['data' => request()->user()->blueiris->connection]);
  }

  public function guest()
  {
    view()->share('config', ['app.class' => 'no-branding', 'main.class' => 'no-menu no-sidebar']);
    $this->setContent('home::guest');
  }

  public function share()
  {
    if (!Home::where('owner_id', auth()->user()->id)->count()) {
      $home = new Home();
      $home->owner_id = auth()->user()->id;
      $home->name = auth()->user()->blueiris->system;
      $home->type = "blueiris";
      $home->save();
    }

    dd(auth()->user()->home);

    view()->share('config', ['app.class' => 'no-branding', 'main.class' => 'no-menu no-sidebar']);
    $this->setContent('home::share', ['data' => auth()->user()->home]);
  }
}