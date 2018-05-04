<?php

namespace Jiko\Home\Http\Controllers;

use Jiko\Http\Controllers\Controller as BaseController;

class EightPageController extends BaseController
{
  public function setup()
  {
    $this->setContent('home::eight.setup');
  }

  public function index()
  {
    if (!auth()->user()->eight) {
      return $this->setup();
    }

    $eightUser = auth()->user()->eight;
    $devices = $eightUser->data;

    return $this->setContent('home::eight.index', ['devices' => $devices]);
  }
}