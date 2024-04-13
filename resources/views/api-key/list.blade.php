<x-app-layout>
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <div class="flex justify-end mb-4">
                        <x-primary-button class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-api-key')">
                            New API Key
                        </x-primary-button>
                    </div>
                    <table class="w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    API Key
                                </th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach ($apiKeys as $apiKey)
                            <tr class="hover:bg-gray-700">
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-300">{{ $apiKey->name }}</div>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-300">{{ $apiKey->key }}</div>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('api-keys.edit', $apiKey->id) }}" class="text-gray-300 hover:text-indigo-400" data-tippy-content="Edit">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('api-keys.destroy', $apiKey->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-300 hover:text-red-400" data-tippy-content="Remove">
                                                <i class="fas fa-trash-alt text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Cadastro de Nova Chave de API -->
    <x-modal name="create-api-key">
        <div class="p-6 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Add New API Key
            </h2>
            <div class="mt-2">
                <form action="{{ route('api-keys.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-start text-gray-700 dark:text-gray-300" for="name">
                            Name
                        </label>
                        <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" required="required" autofocus="autofocus" autocomplete="name">
                    </div>
                    <div class="mt-6 flex justify-end gap-4">
                        <x-danger-button type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300">
                            Close
                        </x-danger-button>
                        <x-primary-button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300">
                            Save
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>
</x-app-layout>
