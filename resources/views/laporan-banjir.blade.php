<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Banjir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("Laporkan Banjir Di Area Anda") }}
                </div>
                <div class="form sm:px-6">
                    <div class="mb-3">
                        <label for="lokasi">Lokasi :</label>
                        <input type="text" id="lokasi" name="lokasi" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Lokasi Banjir">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi :</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Deskripsi Banjir">
                    </div>
                    <div class="mb-3">
                        <label for="foto">Foto :</label>
                        <input type="file" id="foto" name="foto" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-3">
                        <button class="bg-blue-500 text-white p-2 rounded-lg">Kirim Laporan</button>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("List Laporan Banjir") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
