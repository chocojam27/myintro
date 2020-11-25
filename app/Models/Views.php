<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    protected $table = 'views';
    protected $fillable = ['genPage_id','profile_id','ips'];
    // protected $with = ['profile','url'];


    // relationship

    public function profile()
    {
        return $this->hasMany('App\Models\Profile', 'id', 'profile_id');
    }
    public function url()
    {
        return $this->hasMany('App\Models\GeneratedPage', 'id', 'genPage_id');
    }

}
