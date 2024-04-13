<x-app-layout>
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            New User
                        </a>
                    </div>
                    <table class="w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-700">
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-300">{{ $user->name }}</div>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-300">{{ $user->email }}</div>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-300">{{ ucfirst($user->role) }}</div>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-gray-300 hover:text-indigo-400" data-tippy-content="Edit">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
</x-app-layout>
