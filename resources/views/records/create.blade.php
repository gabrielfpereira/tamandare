<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Registro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('records.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-6">
                            <label for="name_student" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Aluno</label>
                            <input name="name_student" value="{{ old('name_student') }}" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="class_student" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Turma do Aluno</label>
                            <input name="class_student" value="{{ old('name_student') }}" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('class_student') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                            <input name="type" value="{{ old('type') }}" type="text" id="class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">                            
                            @foreach ($items as $item)
                                
                                <div class="flex items-center mb-4">
                                    <input name="items[]" id="items-{{ $item->id}}" type="checkbox" value="{{ $item->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="items-{{ $item->id}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                                </div>

                            @endforeach
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Salvar
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>