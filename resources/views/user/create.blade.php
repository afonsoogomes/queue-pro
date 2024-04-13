<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="n" :value="__('Name')" />

                        <x-text-input
                            id="name"
                            class="block mt-1 w-full"
                            type="text"
                            name="name"
                            required="required"
                            autocomplete="name"
                            value="{{ old('name') }}"
                        />

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="Email" :value="__('Email')" />

                        <x-text-input
                            id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            required="required"
                            autocomplete="email"
                            value="{{ old('email') }}"
                        />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input
                            id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required="required"
                            autocomplete="password"
                        />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-start text-gray-700 dark:text-gray-300" for="name">
                            Role
                        </label>
                        <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="role" name="role">
                            <option value="">Select</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('role')" />
                    </div>
                    <div class="mt-6 flex justify-end gap-4">
                        <x-danger-button type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300">
                            Close
                        </x-danger-button>
                        <x-primary-button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300">
                            Create
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
