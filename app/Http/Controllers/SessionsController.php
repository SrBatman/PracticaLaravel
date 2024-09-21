<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SessionsController extends Controller
{
    public function index()
    {
        return view("sessions.index");
    }

    public function create()
    {
        return view("sessions.create");
    }
    public function save(Request $request)
    {

        session('alumnos', []);
        $alumno = [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'encrypted'=> false
        ];

        session()->push('alumnos', $alumno);
        return redirect('/sessions/list');
    }


    public function edit($pos)
    {
        $alumnos = session('alumnos');
        return view('sessions.edit')->with('alumno', $alumnos[$pos])->with('pos', $pos);
    }


    public function update($pos, Request $request)
    {
        $alumnos = session('alumnos');
        $alumno = $alumnos[$pos];
        $alumno['email'] = $request->email;
        $alumno['password'] = $request->password;
        $alumno['name'] = $request->name;
        $alumno['encrypted'] = false;

        $alumnos[$pos] = $alumno;
        session()->put('alumnos', $alumnos);
        return redirect('/sessions/list');
    }
    public function delete($pos)
    {
        $alumnos = session('alumnos');
        unset($alumnos[$pos]); 
        $alumnos = array_values($alumnos); // Reindexamos el array pq php es raro
        session()->put('alumnos', $alumnos); 
        return redirect('/sessions/list');
    }
    public function encrypt ($pos, Request $request) {
        $alumnos = session('alumnos');
        $alumno = $alumnos[$pos];
        
            if (!$alumno['encrypted']) {
                $alumno['email'] = Crypt::encrypt($alumno['email']);
                $alumno['password'] = Crypt::encrypt($alumno['password']);
                $alumno['name'] = Crypt::encrypt($alumno['name']);
                $alumno['encrypted'] = true;
            } else {
                $alumno['email'] = Crypt::decrypt($alumno['email']);
                $alumno['password'] = Crypt::decrypt($alumno['password']);
                $alumno['name'] = Crypt::decrypt($alumno['name']);
                $alumno['encrypted'] = false;
            }
           


            $alumnos[$pos] = $alumno;
            session()->put('alumnos', $alumnos);

        

        return redirect('/sessions/list');
    }
    
}
