<x-app-layout>
    <x-propios.principal>
       
        

<div class="relative overflow-x-auto">
    <div class="flex flex-row-reverse">
        <a class="mb-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('categories.create')}}"><i class="fas fa-add mr-2"></i>Crear una nueva categoria</a>
    </div>
    <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>

                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoria as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$item -> nombre}}
                </th>
                <td class="px-6 py-4">
                    <form action="{{route('categories.destroy' , $item -> id)}}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{route('categories.edit' , $item -> id)}}"><i class="fas fa-edit text-yellow-600 mr-2"></i></a>
                    <button><i class="fas fa-trash text-red-600"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    </x-propios.principal>
</x-app-layout>