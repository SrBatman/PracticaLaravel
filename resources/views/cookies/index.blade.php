@extends ('templates.layout')

@section('content')

<div class="relative overflow-x-auto">
    <a href="/cookies/create" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Nuevo alumno (Galletas 🍪)</a>
    <button id="toggle-encryption" onclick="toggleEncryption()" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        Cifrar
    </button>
    @if (!empty($alumnos))
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
          
            @foreach($alumnos as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <span class="field-name">{{ $item['name'] }}</span>
                </th>
                <td class="px-6 py-4">
                    <span class="field-email">{{ $item['email'] }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="field-password">{{ $item['password'] }}</span>
                </td>
                <td class="px-6 py-4">
                    <a href="/cookies/edit/{{ $position }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                </td>
                <td class="px-6 py-4">
                    <form action="/cookies/delete/{{ $position }}" method="POST" onsubmit="return confirm('¿Estás seguro que quieres borrar este alumno?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Borrar
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <form action="/cookies/encrypt/{{ $position }}" method="POST">
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
    <form action="/cookies/destroy" method="POST" onsubmit="return confirm('¿Estás seguro que quieres la galleta?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
            Borrar Galleta
        </button>
    </form>
    @else
    <h1>No hay registros</h1>
    @endif
</div>

<script>
    let banderaxd = false;

    function toggleEncryption() {
        const nameFields = document.querySelectorAll('.field-name');
        const emailFields = document.querySelectorAll('.field-email');
        const passwordFields = document.querySelectorAll('.field-password');
        const button = document.getElementById('toggle-encryption');

        if (!banderaxd) {
            // Cifrar datos
            nameFields.forEach(field => field.textContent = btoa(field.textContent));
            emailFields.forEach(field => field.textContent = btoa(field.textContent));
            passwordFields.forEach(field => field.textContent = btoa(field.textContent));
            button.textContent = 'Descifrar';
        } else {
            // Descifrar datos
            nameFields.forEach(field => field.textContent = atob(field.textContent));
            emailFields.forEach(field => field.textContent = atob(field.textContent));
            passwordFields.forEach(field => field.textContent = atob(field.textContent));
            button.textContent = 'Cifrar';
        }

        banderaxd = !banderaxd;
    }
</script>

@endsection