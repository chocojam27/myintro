<?php

namespace App\Http\Controllers;

use View;
use App\Models\Configuration;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->data['configuration'] = Configuration::find(1);
        $this->data['social'] = json_decode($this->data['configuration']->social_media_links,true);
        $this->data['contacts'] = json_decode($this->data['configuration']->contact_number,true);
        View::share($this->data);
    }
}
