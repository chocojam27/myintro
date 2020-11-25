<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuration;
use App\User;
use File, Auth, Image;
class DefaultSetting extends Model
{
    public static function updateDefaultAvatar($request)
    {
        $data = self::find(1);
        if($request->hasFile('avatar')){
            $file_name = $request->file('avatar');
            $generated_filename = $file_name->getClientOriginalName();
            $data->avatar = $generated_filename;
            $admin = User::where('role', 10)->first();
            $admin->avatar = $file_name;
            $admin->save();
        }
        $data->save();
        return $data;
    }
    public static function updateDefaultCover($request)
    {
        $data = self::find(1);
        $path = public_path().'/uploads/cover/'.Auth::user()->id.'/';
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if($request->hasFile('cover')){
            $file_name = $request->file('cover');
            $file = Image::make($file_name);
            $generated_filename = $file_name->getClientOriginalName();
            // $file->move($path, $generated_filename);
            $file->save($path.''.$generated_filename);
            $data->cover = $generated_filename;
        }
        $data->save();
        return $data;
    }
}
