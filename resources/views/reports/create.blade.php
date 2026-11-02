<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-sky-800">Form Pelaporan Banjir</h2>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-md border border-sky-300 bg-sky-50 px-4 py-3 text-sm text-sky-800">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('lapor.store') }}" class="space-y-6 rounded-lg border border-sky-100 bg-white p-6 shadow-sm shadow-sky-100">
            @csrf

            <div>
                <x-input-label for="name" value="Nama Pelapor" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone" value="Nomor Telepon" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="address" value="Alamat Lokasi Banjir" />
                <textarea id="address" name="address" rows="2" required class="mt-1 block w-full rounded-md border-sky-200 shadow-sm focus:border-sky-500 focus:ring-sky-500">{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" value="Keterangan Kejadian" />
                <textarea id="description" name="description" rows="5" required class="mt-1 block w-full rounded-md border-sky-200 shadow-sm focus:border-sky-500 focus:ring-sky-500">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <x-primary-button>Kirim Laporan</x-primary-button>
        </form>
    </div>
</x-app-layout>
