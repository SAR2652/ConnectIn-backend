<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentForPack extends Model
{
    protected $table = 'tbl_tournaments';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
