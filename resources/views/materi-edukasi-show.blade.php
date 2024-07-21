<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materi Edukasi > '. $edukasi->judul) }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900 flex justify-between">
                    <div>
                        <h1 class="font-bold">{{ __($edukasi->judul) }}</h1>
                        <small>{{ date('j F, Y H:i:s', strtotime($edukasi->created_at)) }}</small>
                    </div>
                    <div>
                        <a class="underline hover:bg-slate-300" href="{{ route('materi-edukasi') }}">Kembali</a>
                    </div>
                </div>
                {{-- Card list materi --}}
                <div class="px-6 mb-6">
                    <p>
                        {!! nl2br($edukasi->konten) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
