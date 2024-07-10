<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dispositivos
    </h2>
    <p>Lista de todos los Dispositivos que no son Computadores.</p>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if(session()->has('message'))
                <div class="bg-green-100 rounded-b text-green-900 px-4 py-4 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <h4>{{ session('message') }}</h4>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex justify-between mb-4">
                <button wire:click="crear()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Agregar Dispositivo</button>
                <input type="text" wire:model="search" placeholder="Búsqueda" class="form-input rounded-md shadow-sm mt-1 block w-full">
            </div>

            @if($modal)
                @include('livewire.crear')
            @endif

            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Ubicación</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Categoría</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Encargado</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Marca</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Modelo</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Número de Serie</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm uppercase font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dispositivos as $dispositivo)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $dispositivo->ubicacion }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $dispositivo->categoria }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $dispositivo->encargado }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $dispositivo->marca }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $dispositivo->modelo }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $dispositivo->numero_serie }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <button wire:click="editar({{ $dispositivo->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="borrar({{ $dispositivo->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $dispositivos->links() }}
            </div>
        </div>
    </div>
</div>