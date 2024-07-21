<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edukasi Mengenai Banjir') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->role == 'admin')
            <button class="bg-slate-500 hover:bg-slate-600 text-white p-3 rounded px-5">
                Buat Materi
            </button>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("Materi Baru") }}
                </div>
                {{-- Card materi baru --}}
                <form action="{{ route('materi-edukasi.store') }}" method="POST">
                    @csrf
                    <div class="px-6 mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi</label>
                        <input type="text" name="judul" id="judul" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mt-3">Deskripsi Materi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <div class="px-6 mb-6">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded px-5">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900 font-bold">
                    {{ __("List Materi") }}
                </div>
                {{-- Card list materi --}}
                <div class="px-6 mb-6">
                    @if($listEdukasi->isEmpty())
                    <p class="text-center">Belum ada materi saat ini</p>
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach ($listEdukasi as $item)
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-2 pt-5 px-6 text-gray-900 font-bold">
                                {{ __($item->judul) }}
                            </div>
                            <div class="px-6 mb-6">
                                <p class="text-gray-700 mb-4">
                                    {{-- Ambil 100 kata dan lanjutkan dengan ..., juga garis baru dari textarea --}}
                                    {!! Str::limit(nl2br($item->konten), 100, '...') !!}
                                </p>
                                {{-- Link --}}
                                <a href="{{ route('materi-edukasi.show', $item->url) }}" class="underline hover:bg-slate-300">
                                    Lanjut Membaca
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
