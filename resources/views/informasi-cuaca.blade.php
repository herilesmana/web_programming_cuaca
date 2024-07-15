<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Cuaca') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Informasi Cuaca dan Curah Hujan") }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mt-6">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Curah Hujan</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            50 mm
                        </p>
                    </div>
                </div>
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Perkiraan Cuaca</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            Cerah
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
