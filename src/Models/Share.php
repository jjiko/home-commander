<?php

namespace Jiko\Home\Share;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
  protected $connection = "home";
  protected $table = "share";
}