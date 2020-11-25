<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profile_placeholder extends Model
{
    protected $table = 'profile_placeholder';
    protected $fillable = ['user_id', 'placeholder_IDs', 'placeholder_contents'];
}
