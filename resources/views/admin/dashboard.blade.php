<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100"style="color: #2EB4DE;">Welcome to the Admin Dashboard</h1>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">Admin Actions</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('admin.products.add') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            Add Products to Diashop
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            Manage Products
                        </a>
                    </div>
                </div>

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-2xl font-semibold mb-6">{{ __('Doctor Profiles') }}</h3>
                                <table class="min-w-full bg-white dark:bg-gray-800">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b border-gray-200">{{ __('Name') }}</th>
                                            <th class="py-2 px-4 border-b border-gray-200">{{ __('Email') }}</th>
                                            <th class="py-2 px-4 border-b border-gray-200">{{ __('Specialty') }}</th>
                                            <th class="py-2 px-4 border-b border-gray-200">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($doctors as $doctor)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $doctor->name }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $doctor->email }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">{{ $doctor->specialty }}</td>
                                                <td class="py-2 px-4 border-b border-gray-200">
                                                    <a href="{{ route('doctor.editProfile', $doctor->id) }}" class="text-blue-500">{{ __('Edit') }}</a>
                                                    <form action="{{ route('doctor.deleteProfile', $doctor->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        <button type="submit" class="text-red-500 ml-4">{{ __('Delete') }}</button>
                                                    </form>
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
        </div>
    </div>
    <x-flash-message />
</x-app-layout>
