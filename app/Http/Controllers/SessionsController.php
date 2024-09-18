<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'name' => $request->name
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

        $alumnos[$pos] = $alumno;
        session()->put('alumnos', $alumnos);
        return redirect('/sessions/list');
    }
    public function destroy($pos)
    {
        $alumnos = session('alumnos');
        unset($alumnos[$pos]); 
        $alumnos = array_values($alumnos); // Reindexamos el array pq php es raro
        session()->put('alumnos', $alumnos); 
        return redirect('/sessions/list');
    }
}
