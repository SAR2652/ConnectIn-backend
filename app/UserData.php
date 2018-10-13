<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'tbl_users';
    
    public $timestamp = false;
}
