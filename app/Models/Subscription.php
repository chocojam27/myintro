<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscription';

    protected $fillable = [
        'user_id', 'subscription_type', 'start_date'
    ];
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['invoices'];


    // relationship
    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice', 'user_id', 'user_id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'user_id', 'user_id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
