<?php

namespace App;

use Auth, File, Image;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['subscription'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'ips', 'email', 'password', 'avatar', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Backend Update
    |------------------------------------------------------------------------------------
    */
    public static function changeCredentials($request)
    {
        $admin = Auth::user();
        if($admin->role == 10){
            $admin->email = $request->new_email;
            $admin->save();
            if($request->new_password){
                $admin->password = $request->new_password;
                $admin->save();
            } return true;
        } return false;
    }
    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function subscription(){
        return $this->hasOne('App\Models\Subscription','user_id','id');
    }
    public function profile(){
        return $this->hasOne('App\Models\Profile','user_id','id');
    }
    /*
    |------------------------------------------------------------------------------------
    | Attributes
    |------------------------------------------------------------------------------------
    */
    public function setPasswordAttribute($value = '')
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute($value)
    {
        if (!$value) {
            return 'http://placehold.it/160x160';
        }

        return '/uploads/avatar/'.rawurlencode($value);
    }
    public function setAvatarAttribute($photo)
    {
        $path = public_path().'/uploads/avatar/';
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file_name = $photo;
        $file = Image::make($file_name);
        $generated_filename = $file_name->getClientOriginalName();
        $file->save($path.''.$generated_filename);

        $this->attributes['avatar'] = $generated_filename;
    }

    /*
    |------------------------------------------------------------------------------------
    | Boot
    |------------------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::updating(function ($user) {
            $original = $user->getOriginal();

            if (\Hash::check('', $user->password)) {
                $user->attributes['password'] = $original['password'];
            }
        });
    }
}
