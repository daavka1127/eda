<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rank extends Model
{
  protected $table = 'tbRank';
  public $primaryKey = 'rankID';
  public $timestamps = false;
}
