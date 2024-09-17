<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncryptionsController extends Controller
{
    //
    public function index(){
        return view("encryptions.index");
    }

    public function create(){
        return view("encryptions.create");
    }
    public function save(Request $data){
        dd($data->all());

    }
}
