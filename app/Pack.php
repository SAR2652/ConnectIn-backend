<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $table = 'tbl_pack';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
