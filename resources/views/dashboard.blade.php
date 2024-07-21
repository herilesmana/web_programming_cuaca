<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard, ' . auth()->user()->kota_lokasi) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang") }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mt-6">
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="w-full">
                        <h2 class="mt-1 text-xl font-semibold text-gray-900 dark:text-white text-center">Cuaca Hari Ini</h2>

                        <p class="mt-4 text-gray-500 flex flex-col items-center text-center dark:text-gray-400 text-sm leading-relaxed">
                            @if($cuaca_terkini)
                                <small class="text-sm">{{ $cuaca_terkini['cuaca'] == '' ? 'Cerah' : $cuaca_terkini['cuaca'] }}</small>
                                <img style="width: 100px" src="{{ 'https://ibnux.github.io/BMKG-importer/icon/'.$cuaca_terkini['kodeCuaca'].'.png' }}" alt="Image Cuaca">
                                <small class="text-sm">{{ date('j F, Y', strtotime(explode(' ', $cuaca_terkini['jamCuaca'])[0])) }}</small>
                                <small class="text-sm">{{ explode(' ', $cuaca_terkini['jamCuaca'])[1] }}</small>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <h2 class="mt-1 text-xl font-semibold text-gray-900 dark:text-white">Status Siaga Banjir</h2>

                        @if($cuaca_terkini)
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            @if($cuaca_terkini['kodeCuaca'] == '60' || $cuaca_terkini['kodeCuaca'] == '61')
                                <div class="bg-yellow-500 text-white p-2 rounded-lg">
                                    <small class="text-lg px-2">Siapkan Payung</small>
                                </div>
                            @elseif($cuaca_terkini['kodeCuaca'] == '63' || $cuaca_terkini['kodeCuaca'] == '80' || $cuaca_terkini['kodeCuaca'] == '95' || $cuaca_terkini['kodeCuaca'] == '97')
                                <div class="bg-red-500 text-white p-2 rounded-lg">
                                    <small class="text-lg px-2">Waspadai Banjir</small>
                                </div>
                            @else
                                <div class="bg-green-500">
                                    <small class="text-lg px-2">Cuaca Aman</small>
                                </div>
                            @endif
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            <p class="mt-5 text-sm text-gray-500">Sumber data dari BMKG</p>
        </div>
    </div>
</x-app-layout>

@if(auth()->user()->kota_lokasi == null)
<script>
    alert('Silahkan isi data kota anda terlebih dahulu');

    window.location.href = "{{ url('/profile') }}";
</script>
@endif
