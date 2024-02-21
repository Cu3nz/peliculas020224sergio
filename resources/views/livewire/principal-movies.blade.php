<div>
    <x-propios.principal>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Info
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Poster
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                        <i class="fas fa-sort mr-3"></i>Titulo
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                        <i class="fas fa-sort mr-1"></i>Categoria
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('disponible')">
                        <i class="fas fa-sort mr-1"></i> Disponible
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $item)
                <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <button wire:click="detalle(49)"><i class="fas fa-info text-blue-600"></i></button>
                        </td>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-14 h-20 rounded-full" src="{{Storage::url($item -> caratula)}}"
                                alt="Jese image">
                        </th>
                        <td class="px-6 py-4">
                            {{$item -> titulo}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item -> nombre}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center cursor-pointer"
                                wire:click="actualizarDisponibilidad({{$item -> idm}})">
                                <div @class(["h-2.5 w-2.5 rounded-full me-2",
                                'bg-green-600' => $item -> disponible == 'SI',
                                'bg-red-600' => $item -> disponible == 'NO'])></div> {{$item -> disponible}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="pedirConfirmacion({{$item -> idm}})"> 
                                <i class="fas fa-trash text-red-600"></i>
                            </button>
                            <button wire:click="edit(49)">
                                <i class="fas fa-edit text-yellow-600"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="my-2">
            {{$movies -> links()}}
        </div>
    </x-propios.principal>
</div>
