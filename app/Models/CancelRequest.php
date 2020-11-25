<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelRequest extends Model
{
    protected $table = 'cancel_request';
    protected $fillable =['user_id'];
}
