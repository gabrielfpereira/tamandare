<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Alunos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center justify-between mb-6">
                        <div class="w-1/2 mb-6">
                            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pesquisar</label>
                            <form class="flex items-center mr-3" action="{{ route('students.index') }}" method="GET">
                                @csrf
                                @method('GET')
                                <input name="search" placeholder="Digite o nome do aluno" type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <input name="search_class" placeholder="Digite a turma do aluno" type="text" id="base-input" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <button class="ml-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Pesquisar</button>
                            </form>
                        </div>

                        <a href="{{ route('students.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Cadastrar
                        </a>
                    </div>

                    
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nome do Aluno
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Turma
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $student->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $student->class }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('students.edit', $student) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                        
                                        <form  action="{{ route('students.destroy', $student)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="submitForm(event.target.parentElement)" type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $students->withQueryString()->links() }}
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