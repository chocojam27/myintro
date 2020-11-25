<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedPage extends Model
{
    // Protected
    protected $table = 'generated_page';
    protected $fillable=['name','user_id','page_id','url','placeholder_ids','placeholder_values'];
    protected $with = ['clicks','views'];

    // relations
    public function clicks()
    {
        return $this->hasMany('App\Models\Clicks', 'genPage_id', 'id');
    }
    public function views()
    {
        return $this->hasMany('App\Models\Views', 'genPage_id', 'id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    // rules
    public static function rules()
    {
        return $commun = [
                'urlName'   => "required|string",
            ];

    }
}
