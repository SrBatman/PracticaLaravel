<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index(){
        return view("sessions.index");
    }

    public function create(){
        return view("sessions.create");
    }
    public function save(Request $data){
        dd($data->all());

    }
}
