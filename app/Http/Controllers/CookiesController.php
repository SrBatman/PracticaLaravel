<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class CookiesController extends Controller
{
    //  
    public function index(Request $request)
    {
        $busqueda = $request->cookie('alumnos'); // Si existe devuelve un Arreglo [] sino null
        $alumnos =  $busqueda ? json_decode($busqueda, true) : [];
        
        return view("cookies.index", ['alumnos' => $alumnos]);
    }

    public function create()
    {
        return view("cookies.create");
    }
    public function save(Request $request)
    {

        $migalleta = $request->cookie('alumnos');
        $alumnos = $migalleta ? json_decode($migalleta, true) : [];
        $alumno = [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'encrypted'=> false,
        ];

        $alumnos[] = $alumno;

        
        $jsonAlumnos = json_encode($alumnos);
        $cookie = cookie('alumnos', $jsonAlumnos, 60);
        return redirect('/cookies/list')->cookie($cookie);;
    }


    public function edit($pos, Request $request)
    {
        $migalleta = $request->cookie('alumnos');
        $alumnos = json_decode($migalleta, true);
        return view('cookies.edit')->with('alumno', $alumnos[$pos])->with('pos', $pos);
    }


    public function update($pos, Request $request)
    {
        $migalleta = $request->cookie('alumnos');
        $alumnos = $migalleta ? json_decode($migalleta, true) : [];

        if (isset($alumnos[$pos])) {
            $alumnos[$pos]['email'] = $request->email;
            $alumnos[$pos]['password'] = $request->password;
            $alumnos[$pos]['name'] = $request->name;
            $alumnos[$pos]['encrypted'] = false;

            $jsonAlumnos = json_encode($alumnos);
            $cookie = cookie('alumnos', $jsonAlumnos, 60); 
           
            return redirect('/cookies/list')->cookie($cookie);
        }

        // Si hay un error, pss igual redirecciona pero con el mensaje :P
        return redirect('/cookies/list')->with('error', 'Alumno no encontrado.');
    }
    public function delete($pos, Request $request)
    {
       
        $migalleta = $request->cookie('alumnos');
        $alumnos = $migalleta ? json_decode($migalleta, true) : [];

        
        if (isset($alumnos[$pos])) {
            unset($alumnos[$pos]);
            $alumnos = array_values($alumnos); 

            $jsonAlumnos = json_encode($alumnos);
            $cookie = cookie('alumnos', $jsonAlumnos, 60);
            
            return redirect('/cookies/list')->cookie($cookie);
        }

        return redirect('/cookies/list')->with('error', 'Alumno no encontrado.');
    
    }

    public function destroy(Request $request){
        Cookie::queue(Cookie::forget('alumnos'));
        return redirect('/cookies/list');
    }

    public function encrypt ($pos, Request $request) {
        $migalleta = $request->cookie('alumnos');
        $alumnos = $migalleta ? json_decode($migalleta, true) : [];

        if (isset($alumnos[$pos])) {
            if (!$alumnos[$pos]['encrypted']) {
                $alumnos[$pos]['email'] = Crypt::encrypt($alumnos[$pos]['email']);
                $alumnos[$pos]['password'] = Crypt::encrypt($alumnos[$pos]['password']);
                $alumnos[$pos]['name'] = Crypt::encrypt($alumnos[$pos]['name']);
                $alumnos[$pos]['encrypted'] = true;
            } else {
                $alumnos[$pos]['email'] = Crypt::decrypt($alumnos[$pos]['email']);
                $alumnos[$pos]['password'] = Crypt::decrypt($alumnos[$pos]['password']);
                $alumnos[$pos]['name'] = Crypt::decrypt($alumnos[$pos]['name']);
                $alumnos[$pos]['encrypted'] = false;
            }
           


            $jsonAlumnos = json_encode($alumnos);
            $cookie = cookie('alumnos', $jsonAlumnos, 60); 
           
            return redirect('/cookies/list')->cookie($cookie);
        }

        // Si hay un error, pss igual redirecciona pero con el mensaje :P
        return redirect('/cookies/list')->with('error', 'Alumno no encontrado.');
    }
}
