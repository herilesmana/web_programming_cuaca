<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Cuaca, '. auth()->user()->kota_lokasi) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Informasi Cuaca dan Curah Hujan") }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 mt-6">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="w-full">
                        <h2 class="mt-2 text-xl text-center font-semibold text-gray-900 dark:text-white">Cuaca Terkini</h2>

                        <p class="mt-4 w-full items-center flex flex-col align-center dark:text-gray-400 text-sm leading-relaxed">
                            {{-- <div class=""> --}}
                                @if($cuaca_terkini)
                                <small class="text-sm">{{ $cuaca_terkini['cuaca'] }}</small>
                                <img style="width: 100px" src="{{ 'https://ibnux.github.io/BMKG-importer/icon/'.$cuaca_terkini['kodeCuaca'].'.png' }}" alt="Image Cuaca">
                                <small class="text-sm">{{ date('j F, Y', strtotime(explode(' ', $cuaca_terkini['jamCuaca'])[0])) }}</small>
                                <small class="text-sm">{{ explode(' ', $cuaca_terkini['jamCuaca'])[1] }}</small>
                                @endif
                                {{-- </div> --}}
                        </p>
                    </div>
                </div>
                <div class="scale-100 col-span-3 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">Perkiraan Cuaca</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            <div class="grid grid-cols-2 md:grid-cols-8 gap-2">
                                @foreach ($cuaca as $c)
                                <div class="border rounded p-2">
                                    <small class="text-xs">{{ $c['cuaca'] == '' ? 'Cerah' : $c['cuaca'] }}</small>
                                    <img src="{{ 'https://ibnux.github.io/BMKG-importer/icon/'.$c['kodeCuaca'].'.png' }}" alt="Image Cuaca">
                                    <small class="text-xs">{{ date('j F, Y', strtotime(explode(' ', $c['jamCuaca'])[0])) }}</small>
                                    <small class="text-xs">{{ explode(' ', $c['jamCuaca'])[1] }}</small>
                                </div>
                                @endforeach
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            <p class="mt-5 text-sm text-gray-500">Sumber data dari BMKG</p>
        </div>
    </div>
</x-app-layout>

@if(count($cuaca) <= 0)
<script>
    alert('Silahkan isi data kota anda terlebih dahulu');

    window.location.href = '/profile';
</script>
@endif
