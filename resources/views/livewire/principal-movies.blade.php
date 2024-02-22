<div>
    <x-propios.principal>
        <div class="flex w-full mb-1 items-center">
            <div class="flex-1">
                
                <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-3/4" type="search" placeholder="Buscar..." wire:model.live="buscar">
            </div>

            <div>
                @livewire('crear-movies')
            </div>

        </div>
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
                            <button wire:click="info({{$item -> idm}})"><i class="fas fa-info text-blue-600"></i></button>
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
                            <button wire:click="edit({{$item -> idm}})">
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


        
        {{-- todo Para el info --}}
        @isset($pelicula -> caratula)
            
        
        <x-dialog-modal>
            <x-slot name="title">
                Informacion de la pelicula
            </x-slot>
            <x-slot name="content">

                <div class="max-w-sm w-full mx-auto mt-50 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">


                    <img class="rounded-t-lg w-full bg-no-repeat" src="{{Storage::url($pelicula -> caratula)}}" alt="">

                    <div class="p-5">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$pelicula -> titulo}}</h5>

                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$pelicula -> sinopsis}}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Categoria: {{$pelicula -> category -> nombre}}</p>
                        <p @class(["mb-3 font-normal text-gray-700",
                        'text-red-600' => $pelicula -> disponible == "NO", 
                        'text-green-600' => $pelicula -> disponible == "SI"])>Disponible: {{$pelicula -> disponible}}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pelicula Registrada: {{$pelicula -> created_at}}</p>

                        <div class="flex">
                            @foreach ($pelicula -> tags as $item)
                            
                            <div class="p-1 rounded mr-1" style="background-color: {{$item -> color}}">
                                {{$item -> nombre}}
                            </div>

                            @endforeach
                        </div>

                    </div>

                </div>

            </x-slot>
            <x-slot name="footer">

                <button class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                wire:click="salirModalInfo">
                <i class="fas fa-xmark"></i> Salir</button>
            </x-slot>
        </x-dialog-modal>
        @endisset
        {{-- todo fIN MODAL Para el info --}}



        {{-- todo Modal update --}}

        @isset($form -> movie)
            
        
        <x-dialog-modal>
            <x-slot name="title">
                Actualizar movie
            </x-slot>
    
            <x-slot name="content">
    
                <div class="mt-4 text-sm text-gray-600">
                    <label class="block font-medium text-sm text-gray-700" for="titulo">
                        Titulo
                    </label>
    
                    <input
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mb-3 mt-2"
                        type="text" placeholder="Titulo" id="titulo" wire:model="form.titulo">
    
                    <x-input-error for="form.titulo"></x-input-error>
    
                    <label class="block font-medium text-sm text-gray-700" for="sinopsis">
                        Sinopsis
                    </label>
                    <textarea class="w-full mb-3" name="sinopsis" id="sinopsis" cols="30" wire:model="form.sinopsis"></textarea>
                    <x-input-error for="form.sinopsis"></x-input-error>
    
                    <label class="block font-medium text-sm text-gray-700" for="categoria">
                        Categoria
                    </label>
                    <select name="" id="categoria" class="w-full mb-3" wire:model="form.category_id">
                        <option value="">------- SELECCIONA CATEGORIA ----------</option>
                        @foreach ($categorias as $item)
                            <option value="{{$item -> id}}">{{$item -> nombre}}</option>
                        @endforeach
                    </select>
    
                    <x-input-error for="form.category_id"></x-input-error>
    
                    <label class="block font-medium text-sm text-gray-700" for="disponible">
                        Disponible
                    </label>
                    <input id="disponible" name="disponible" type="checkbox" value="SI"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Si
                        <x-input-error for="form.disponible"></x-input-error>
    
                    <!-- Etiquetas -->
                    <label class="block font-medium text-sm text-gray-700" for="etiquetas">
                        Etiquetas
                    </label>
                    <div class="flex flex-wrap mb-5">
                        
                            @foreach ($Mistags as $item)
                            <input id="{{$item -> id}}" type="checkbox" wire:model="form.tags" value="{{$item -> id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="{{$item -> id}}" style="background-color: {{$item -> color}}" class="ms-2 p-2 text-sm font-medium text-white rounded mr-2">{{$item -> nombre}}</label>
                            @endforeach
                    </div>
                    <x-input-error for="form.tags"></x-input-error>
    
                    <label class="block font-medium text-sm text-gray-700" for="imagenU">
                        Caratula
                    </label>
    
                    <div class="w-full h-80 bg-gray-200 relative">
                        <input type="file" accept="image/*" hidden id="imagenU" wire:model="form.imagen"
                        wire:loading.attr="disabled">
                        <label for="imagenU"
                            class="absolute bottom-2 right-2 bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">SUBIR</label>
                        @if ($form -> imagen)
                        <img src="{{$imagen -> temporaryUrl()}}"
                        class="p-1 rounded w-full h-full br-no-repeat bg-cover bg-center"/>
                        @else
                        <img src="{{Storage::url($form -> movie -> caratula)}}"
                        class="p-1 rounded w-full h-full br-no-repeat bg-cover bg-center"/>
                        @endif
                        <x-input-error for="form.imagenU"></x-input-error>
                    </div>
                </div>
    
    
            </x-slot>
    

            <x-slot name="footer">
    
                <button wire:click="update" wire:loading.attr="disabled"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> GUARDAR
                </button>
    
                <button class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="salirModalCreate">
                    <i class="fas fa-xmark"></i> CANCELAR</button>
    
            </x-slot>
        </x-dialog-modal>
        @endisset

        {{-- todo Fin Modal update --}}


    </x-propios.principal>
</div>
