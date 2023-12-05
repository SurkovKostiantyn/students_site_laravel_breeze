<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mb-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Users profiles list') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-white">ID</th>
                            <th class="px-4 py-2 text-white">Last name</th>
                            <th class="px-4 py-2 text-white">First name</th>
                            <th class="px-4 py-2 text-white">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="border px-4 py-2 text-white">{{ $user->id }}</td>
                                <td class="border px-4 py-2 text-white">{{ $user->profile->first_name }}</td>
                                <td class="border px-4 py-2 text-white">{{ $user->profile->last_name }}</td>
                                <td class="border px-4 py-2 text-white">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white mb-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Admins list') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-white">ID</th>
                            <th class="px-4 py-2 text-white">First name</th>
                            <th class="px-4 py-2 text-white">Last name</th>
                            <th class="px-4 py-2 text-white">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td class="border px-4 py-2 text-white">{{ $admin->user->id }}</td>
                                <td class="border px-4 py-2 text-white">{{ $admin->user->profile->first_name }}</td>
                                <td class="border px-4 py-2 text-white">{{ $admin->user->profile->last_name }}</td>
                                <td class="border px-4 py-2 text-white">{{ $admin->user->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="bg-white mb-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Add new admin') }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <form method="post" action="{{ route('admin.addAdmin') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <label for="select-admin" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Select user') }}
                        </label>
                        <select name="id" id="select-admin" class="m-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            @foreach($list as $user)
                                <option value="{{ $user->id }}">User ID: {{ $user->id }} | User login: {{ $user->login }}</option>
                            @endforeach
                        </select>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Add') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


