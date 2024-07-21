{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Select lokasi --}}
        <div>
            <x-input-label for="lokasi" :value="__('Lokasi')" />
            <select id="lokasi" name="id_lokasi" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">{{ __('Pilih Lokasi') }}</option>
                @foreach ($lokasi as $wilayah)
                    <option value="{{ $wilayah['id'] }}" {{ old('id_lokasi', $user->id_lokasi) == $wilayah['id'] ? 'selected' : '' }}>{{ $wilayah['kota'] }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('lokasi')" />
        </div>

        <div>
            <x-input-label for="kota_lokasi" :value="__('Kota')" />
            <x-text-input id="kota_lokasi" name="kota_lokasi" type="text" class="mt-1 block w-full" readonly :value="old('kota_lokasi', $user->kota_lokasi)" required autocomplete="Kota" />
            <x-input-error class="mt-2" :messages="$errors->get('kota_lokasi')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    const lokasi = document.getElementById('lokasi');
    const kotaLokasi = document.getElementById('kota_lokasi');

    // When select2 is changed with function khusus select2
    $('#lokasi').on('select2:select', function (e) {
        const data = e.params.data;
        kotaLokasi.value = data.text;
    });

    $(document).ready(function() {
        $('#lokasi').select2();
    });
</script>
