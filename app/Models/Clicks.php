<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clicks extends Model
{
    protected $table = 'clicks';
    protected $fillable = ['social','contact','url','page_id','profile_id','ips'];
    // protected $with = ['user'];

    // relationship
}
