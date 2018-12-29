<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedPacks extends Model
{
    protected $table = 'tbl_saved_packs';

    protected $primaryKey = 'id';

    public $timestamps = false; 
}
