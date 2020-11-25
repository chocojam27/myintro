<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placeholder extends Model
{
    protected $fillable = ['format', 'description'];
    //^[%]+[a-zA-Z|_]+[%]$

    // validations
    public static function rules()
    {
        $place = [
            'format.*'  => ["regex:/^[%]+[a-zA-Z|_]+[%]$/"],
        ];
        return $place;
    }
}
