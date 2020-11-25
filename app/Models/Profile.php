<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth, Image, File;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image', 'template', 'fullname', 'title', 'bio', 'social_provider',
        'social_url','add_contact', 'add_video', 'add_extra_url', 'url', 'theme','email_count','videos'
    ];
    protected $with = ['user'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /*
    |------------------------------------------------------------------------------------
    | Reslationships
    |------------------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function views()
    {
        return $this->hasMany('App\Models\Views', 'profile_id', 'id');
    }
    public function clicks()
    {
        return $this->hasMany('App\Models\Clicks', 'profile_id', 'id');
    }
    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        if($update && $id){
            $commun = [
                'id'                => "required|unique:profiles,id,$id",
                'url'               => "required|unique:profiles,url,$id",
                'user_id'           => "required|unique:profiles,user_id,$id",
                'fullname'          => 'required|string',
                'title'             => 'required|string',
                'bio'               => 'required|string',
                'social_provider'   => 'required|array|min:1',
                'social_url'        => 'required|array|min:1',
            ];

            if ($update) {
                return $commun;
            }

        }else{
            $commun = [
                'url'               => "required|unique:profiles,url",
                'user_id'           => "required|unique:profiles,user_id",
                'fullname'          => 'required|string',
                'title'             => 'required|string',
                'bio'               => 'required|string',
                'social_provider'   => 'required|array|min:1',
                'social_url'        => 'required|array|min:1',
            ];
        }


        return array_merge($commun, [
            'image'              => 'required|image',
            'url'               => 'required|unique:profiles',
            'user_id'           => 'required|unique:profiles',
            'template'          => 'required',
        ]);
    }

    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
    public function getImageAttribute($value)
    {
        if (!$value) {
            return 'http://placehold.it/160x160';
        }

        return rawurlencode($value);
    }
    public function setImageAttribute($photo)
    {
        $path = public_path().'/uploads/avatar/'.Auth::user()->id.'/';
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file_name = $photo;
        $file = Image::make($file_name);
        $generated_filename = $file_name->getClientOriginalName();
        $file->save($path.''.$generated_filename);

        $this->attributes['image'] = $generated_filename;
    }
    public function getSocialProviderAttribute($provider)
    {
        return explode(',', $provider);
    }
    public function setSocialProviderAttribute($provider)
    {
        $this->attributes['social_provider'] = implode(',', $provider);
    }
    public function getSocialUrlAttribute($url)
    {
        return explode(',', $url);
    }
    public function setSocialUrlAttribute($url)
    {
        $this->attributes['social_url'] = implode(',', $url);
    }
    public function getThemeAttribute($theme)
    {
        return json_decode($theme, true);
    }
    public function setThemeAttribute($theme)
    {
        $this->attributes['theme'] = json_encode($theme, true);
    }
}
