@extends ('templates.layout')

@section('content')

<div class="relative overflow-x-auto">
    <a href="/sessions/create" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Nuevo alumno (Sesiones 💻)</a>
    @if (session()->has('alumnos'))
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Password
                </th>
                <th scope="col" class="px-6 py-3">
                    Editar
                </th>
                <th scope="col" class="px-6 py-3">
                    Eliminar
                </th>
            </tr>
        </thead>
        <tbody>
            {{
                $position=0
            }}
         
            @foreach(session('alumnos') as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item['name']}}
                </th>
                <td class="px-6 py-4">

                    {{ $item['email']}}
                </td>
                <td class="px-6 py-4">
                    {{ $item['password']}}
                </td>
                <td class="px-6 py-4">
                    <a href="/sessions/edit/{{ $position }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                </td>
                <td class="px-6 py-4">
                    <form action="/sessions/delete/{{ $position }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres borrar este alumno?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Borrar
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form action="/sessions/encrypt/{{ $position }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Cifrar / Descifrar
                        </button>
                    </form>
                </td>
            </tr>
            {{ $position++ }}
            @endforeach


        </tbody>
    </table>
    @else
    <h1>No hay registros</h1>
    @endif
</div>

@endsection