<div>
    <x-button wire:click="$set('abrirModalCreate' , true)"><i class="fas fa-add mr-2"></i>Crear una pelicula</x-button>

    <x-dialog-modal wire:model="abrirModalCreate">
        <x-slot name="title">
            Crear movies
        </x-slot>

        <x-slot name="content">

            <div class="mt-4 text-sm text-gray-600">
                <label class="block font-medium text-sm text-gray-700" for="titulo">
                    Titulo
                </label>

                <input
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mb-3 mt-2"
                    type="text" placeholder="Titulo" id="titulo" wire:model="titulo">

                <x-input-error for="titulo"></x-input-error>

                <label class="block font-medium text-sm text-gray-700" for="sinopsis">
                    Sinopsis
                </label>
                <textarea class="w-full mb-3" name="sinopsis" id="sinopsis" cols="30" wire:model="sinopsis"></textarea>
                <x-input-error for="sinopsis"></x-input-error>

                <label class="block font-medium text-sm text-gray-700" for="categoria">
                    Categoria
                </label>
                <select name="" id="categoria" class="w-full mb-3" wire:model="category_id">
                    <option value="">------- SELECCIONA CATEGORIA ----------</option>
                    @foreach ($categorias as $item)
                        <option value="{{$item -> id}}">{{$item -> nombre}}</option>
                    @endforeach
                </select>

                <x-input-error for="category_id"></x-input-error>

                <label class="block font-medium text-sm text-gray-700" for="disponible">
                    Disponible
                </label>
                <input id="disponible" name="disponible" type="checkbox" value="SI"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Si
                    <x-input-error for="disponible"></x-input-error>

                <!-- Etiquetas -->
                <label class="block font-medium text-sm text-gray-700" for="etiquetas">
                    Etiquetas
                </label>
                <div class="flex flex-wrap mb-5">
                    
                        @foreach ($Mistags as $item)
                        <input id="{{$item -> id}}" type="checkbox" wire:model="tags" value="{{$item -> id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="{{$item -> id}}" style="background-color: {{$item -> color}}" class="ms-2 p-2 text-sm font-medium text-white">{{$item -> nombre}}</label>
                        @endforeach
                </div>
                <x-input-error for="tags"></x-input-error>

                <label class="block font-medium text-sm text-gray-700" for="imagenC">
                    Caratula
                </label>

                <div class="w-full h-80 bg-gray-200 relative">
                    <input type="file" accept="image/*" hidden id="imagenC" wire:model="imagen"
                    wire:loading.attr="disabled">
                    <label for="imagenC"
                        class="absolute bottom-2 right-2 bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">SUBIR</label>
                    @if ($imagen)
                    <img src="{{$imagen -> temporaryUrl()}}"
                    class="p-1 rounded w-full h-full br-no-repeat bg-cover bg-center"/>
                    @endif
                    <x-input-error for="imagenC"></x-input-error>
                </div>
            </div>


        </x-slot>






        <x-slot name="footer">

            <button wire:click="store" wire:loading.attr="disabled"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save"></i> GUARDAR
            </button>

            <button class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                wire:click="salirModalCreate">
                <i class="fas fa-xmark"></i> CANCELAR</button>

        </x-slot>
    </x-dialog-modal>

</div>
