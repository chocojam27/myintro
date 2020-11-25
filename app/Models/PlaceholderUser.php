<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceholderUser extends Model
{
    /*
    |------------------------------------------------------------------------------------
    | protected
    |------------------------------------------------------------------------------------
    */
    protected $table = 'placeholder_user';
    /*
    |------------------------------------------------------------------------------------
    | Reslationships
    |------------------------------------------------------------------------------------
    */
    public function placeholders()
    {
        return $this->hasMany('placeholder_id', 'App\User');
    }

    public function otherPlaceholders()
    {
        return $this->hasMany('other_placeholder_id', 'App\User');
    }
}
