<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Banjir, ' . auth()->user()->kota_lokasi) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("Laporkan Banjir Di Area Anda") }}
                    <button id="button-laporan" class="bg-slate-500 px-2 rounded text-white hover:bg-slate-600">Buat Laporan</button>
                </div>
                <form class="form sm:px-6" style="display: none" id="form-laporan" method="POST" enctype="multipart/form-data" action="{{ route('laporan-banjir.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="lokasi">Lokasi :</label>
                        <input value="{{ old('lokasi') }}" required type="text" id="lokasi" name="lokasi" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Lokasi Banjir">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi :</label>
                        {{-- <input required type="text" id="deskripsi" name="deskripsi" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Deskripsi Banjir"> --}}
                        {{-- Textarea --}}
                        <textarea required id="deskripsi" name="deskripsi" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Deskripsi Banjir">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto">Foto :</label>
                        <input required type="file" id="foto" name="foto" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="my-6">
                        <button class="bg-green-500 text-white p-2 px-3 hover:bg-green-600 transition duration-300 rounded-lg" type="submit">Kirim Laporan</button>
                    </div>
                </form>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("List Laporan Banjir") }}
                </div>
                <div class="px-6 mb-6">
                    @if(count($listLaporan) <= 0)
                    <p>Tidak ada laporan banjir</p>
                    @else
                    @foreach ($listLaporan as $laporan)
                        <div class="border rounded-lg p-3 px-5 mb-3">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="font-bold flex gap-1">
                                        <div class="text-sm font-normal px-2 rounded w-32 text-center bg-opacity-50 @if($laporan->status == 'waiting') bg-yellow-500 @else bg-green-500 @endif">Status : {{ $laporan->status }}</div>
                                        <div>{{ $laporan->lokasi }}</div>
                                    </div>
                                    <p class="mt-3">{{ $laporan->deskripsi }}</p>
                                    <small>{{ date('j F, Y H:i:s', strtotime($laporan->created_at)) }} - {{ $laporan->user->name }}</small>
                                </div>
                                <div>
                                    <img src="{{ asset('images/' . $laporan->foto_url) }}" alt="Foto Banjir" class="w-20 h-20 rounded object-cover">
                                </div>
                            </div>
                            <div class="mt-3 bg-gray-50 p-4 rounded-lg">
                                <h3 class="mb-2">Follow Up Masalah</h3>
                                @if($laporan->status == 'waiting')
                                    @if(auth()->user()->role == 'petugas')
                                    <div>
                                        <button id="button-{{ $laporan->id }}" class="bg-slate-500 px-2 rounded text-white hover:bg-slate-600">Form Follow Up</button>
                                        <form method="POST" action="{{ route('laporan-banjir.follow-up') }}" id="form-{{ $laporan->id }}" enctype="multipart/form-data" style="display: none">
                                            @csrf
                                            <input type="hidden" name="id_laporan" value="{{ $laporan->id }}">
                                            <div class="mb-2">
                                                <label for="deskripsi">Keterangan :</label>
                                                <textarea required name="deskripsi" id="follow-up-deskripsi-{{ $laporan->id }}" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                                            </div>
                                            {{-- Foto --}}
                                            <div class="mb-2">
                                                <label for="foto">Foto :</label>
                                                <input required type="file" id="follow-up-foto-{{ $laporan->id }}" name="foto" class="w-full p-2 border border-gray-300 rounded-lg">
                                            </div>
                                            <button class="bg-green-500 text-white p-2 px-3 hover:bg-green-600 transition duration-300 rounded-lg mt-2" type="submit">Kirim Follow Up</button>
                                        </form>
                                    </div>
                                    @endif
                                @else
                                    <div class="flex justify-between">
                                        <div>
                                            <p>{{ $laporan->deskripsi_follow_up }}</p>
                                            <small>{{ date('j F, Y H:i:s', strtotime($laporan->follow_up_at)) }} - {{ $laporan->followUpUser->name }}</small>
                                        </div>
                                        <img src="{{ asset('follow_up_images/' . $laporan->follow_up_foto_url) }}" alt="Foto Follow Up" class="w-12 h-w-12 rounded object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {{-- Pagination --}}
                    {{ $listLaporan->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    @foreach($listLaporan as $laporan)
    @if($laporan->status == 'waiting')
    document.getElementById('button-{{ $laporan->id }}').addEventListener('click', function() {
        document.getElementById('form-{{ $laporan->id }}').style.display = 'block';
        // Hide button
        document.getElementById('button-{{ $laporan->id }}').style.display = 'none';
    });
    @endif
    @endforeach

    document.getElementById('button-laporan').addEventListener('click', function() {
        document.getElementById('form-laporan').style.display = 'block';
        // Hide button
        document.getElementById('button-laporan').style.display = 'none';
    });
</script>
