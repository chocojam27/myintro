<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherPlaceholder extends Model
{
    //^[%]+[a-zA-Z|_]+[%]$
    protected $fillable = ['user_id', 'format', 'description'];

    // validations
    public static function rules()
    {
        $place = [
            'placeholder_formats.*'  => ["regex:/^[%]+[a-zA-Z|_]+[%]$/"],
        ];
        return $place;
    }
}
