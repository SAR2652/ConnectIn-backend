<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
