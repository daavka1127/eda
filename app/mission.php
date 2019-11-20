<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mission extends Model
{
    protected $table = 'tbmission';
    public $primaryKey = 'id';
    public $timestamps = false;
}
