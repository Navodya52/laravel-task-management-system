<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl font-bold mb-2">
                        Welcome to Task Management System! 👋
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Manage your tasks, track your progress, and stay organized.
                    </p>


                    <!-- Go to Tasks Button -->

                    <a
                        href="{{ route('tasks.index') }}"
                        class="inline-flex items-center px-5 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Go to Task Management
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>