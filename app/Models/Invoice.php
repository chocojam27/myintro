<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = ['transaction_id', 'title', 'price', 'payment_status', 'recurring_id','cancelled_date'];

    public function getPaidAttribute() {
    	if ($this->payment_status == 'Invalid') {
    		return false;
    	}
    	return true;
    }
}
