<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-sky-800">Profil Petugas</h2>
    </x-slot>

    @php($petugas = Auth::user())

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <dl class="divide-y divide-sky-100 overflow-hidden rounded-lg border border-sky-100 bg-white shadow-sm">
            <div class="grid gap-2 px-6 py-5 sm:grid-cols-3">
                <dt class="font-medium text-slate-600 dark:text-slate-300">Nama</dt>
                <dd class="text-slate-900 sm:col-span-2">{{ $petugas->name }}</dd>
            </div>
            <div class="grid gap-2 px-6 py-5 sm:grid-cols-3">
                <dt class="font-medium text-slate-600 dark:text-slate-300">Email</dt>
                <dd class="text-slate-900 sm:col-span-2">{{ $petugas->email }}</dd>
            </div>
            <div class="grid gap-2 px-6 py-5 sm:grid-cols-3">
                <dt class="font-medium text-slate-600 dark:text-slate-300">Akun dibuat</dt>
                <dd class="text-slate-900 sm:col-span-2">{{ $petugas->created_at->format('d F Y, H:i') }}</dd>
            </div>
        </dl>
    </div>
</x-app-layout>
