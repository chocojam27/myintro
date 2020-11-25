<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTemplate extends Model
{
    // proteccted
    protected $table = 'page_template';
    protected $fillable = ['user_id','page_template_name', 'main_content','full_name','tag'];
    // relation
    public function url()
    {
        return $this->hasMany('App\Models\GeneratedPage', 'page_id', 'id');
    }
    // rules
    public static function rules()
    {
        return $commun = [
                'templateName'                => "required|string",
                'templateTag'               => "required|string",
                'fullName'           => "required|string",
                'mainContent'           => "required",
            ];

    }
}
