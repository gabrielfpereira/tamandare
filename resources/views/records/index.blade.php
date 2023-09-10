<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Registros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="items-center justify-between mb-6 sm:flex">
                        <div class="mb-6 sm:w-2/3">
                            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pesquisar</label>
                            <form class="items-center mr-3 sm:flex" action="{{ route('records.index') }}" method="GET">
                                @csrf
                                @method('GET')
                                <input name="search" placeholder="Digite o nome do aluno" type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <input name="search_class" placeholder="Digite a turma do aluno" type="text" id="base-input" class="sm:ml-2 mt-2 sm:mt-0 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <input name="search_date" placeholder="pesquise por uma data" type="date" id="base-input" class="sm:ml-2 mt-2 sm:mt-0 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <button class="sm:ml-3 mt-2 sm:mt-0 w-full sm:w-24 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Pesquisar</button>
                            </form>
                        </div>

                        <a href="{{ route('records.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Cadastrar
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Turma
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Tipo
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Criação
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $record->student->name }}
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        {{ $record->student->class }}
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        {{ $record->type }}
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        {{ $record->statusList()[$record->status] }}
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        {{ $record->created_at->format('d/m/Y') }}
                                    </th>
                                    
                                    <td class="px-6 py-4">
                                        @can('update', $record)
                                            <a href="{{ route('records.edit', $record) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                            
                                        @endcan
                                        
                                        @can('delete', $record)
                                            <form  action="{{ route('records.destroy', $record)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="submitForm(event.target.parentElement)" type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Excluir</button>
                                            </form>
                                        @endcan

                                        <a href="{{ route('records.show', $record) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                        <a href="{{ route('records.print', $record) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Imprimir</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $records->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <x-alert-success>{{ session('success') }}</x-alert-success>
    @endif

    <x-delete-modal />

    @push('js')
        <script>
            function submitForm(e){
                e.target.preventDefault
                
                document.getElementById('confirm-delete').addEventListener('click', function(){
                    e.submit()
                })
            }
        </script>
    @endpush
</x-app-layout>