<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clicks;
use App\Models\GeneratedPage;
use App\Models\Profile;
use App\Models\Views;
use Illuminate\Http\Request;
use App\User;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::with(['views','clicks'])->get();
        $URL = GeneratedPage::with(['views'])->get();
        return view('admin.stats.index', compact('profile','URL'));
    }

    public function getDetails($method,$id)
    {
        // dd($method);
        // $views = PageInteractions::with('user.profile')->with('pages')->with('profiles')->orderBy('views','Desc')->get();
        // $clicks = PageInteractions::with('user.profile')->with('pages')->with('profiles')->orderBy('clicks','Desc')->get();
        // return view('admin.stats.detailed', compact('views','clicks'));
    }
}
