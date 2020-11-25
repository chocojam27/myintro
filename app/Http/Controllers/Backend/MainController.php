<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        if(Auth::check()){
            if(Auth::user()->role == 10){
                return redirect('/admin/settings');
            }
        }
        return redirect('/admin');
    }
}
