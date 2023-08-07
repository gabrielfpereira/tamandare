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

                    <div class="flex justify-end mb-6">
                        <a href="{{ route('records.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
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
                                        {{ $record->created_at->format('d/m/Y') }}
                                    </th>
                                    
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                        
                                        @can('delete', $record)
                                            <form  action="{{ route('records.destroy', $record)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="submitForm(event.target.parentElement)" type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Excluir</button>
                                            </form>
                                        @endcan

                                        <a href="{{ route('records.show', $record) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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