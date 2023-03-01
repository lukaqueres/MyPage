<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class MyPageController extends BaseController
{

    public function fromJSON(Request $request)
    {
        $json = file_get_contents(base_path('public/me.json'));

        $data = json_decode($json, true);

        collect($data);

        return view('main')->with('data', $data);
    }
}
