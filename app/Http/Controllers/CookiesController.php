<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookiesController extends Controller
{
    //
    public function index(){
        return view("cookies.index");
    }

    public function create(){
        return view("cookies.create");
    }
    public function save(Request $data){
        dd($data->all());

    }
}
