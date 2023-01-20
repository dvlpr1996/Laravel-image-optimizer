<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;

class ActionController extends Controller
{
    public function action(FileRequest $request)
    {
        # file type
        # action based on file type    design patter
        dd($request->file());
    }
}
