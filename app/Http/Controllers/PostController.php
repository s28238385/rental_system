<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//use App\Post;


class PostController extends Controller
{
    //
    public function store_short()
    {
        return view("reservation/classroom_short");
    }

    public function store_long()
    {
        return view("reservation/classroom_long");
    }
    


}