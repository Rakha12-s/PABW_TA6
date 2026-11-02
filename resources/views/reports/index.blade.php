<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-sky-800">Daftar Laporan Banjir</h2>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-md border border-sky-300 bg-sky-50 px-4 py-3 text-sm text-sky-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-sky-100 bg-white p-4 shadow-sm"><p class="text-sm text-slate-500">Semua Laporan</p><p class="mt-1 text-3xl font-bold text-sky-700">{{ $summary['all'] }}</p></div>
            <div class="rounded-lg border border-sky-100 bg-white p-4 shadow-sm"><p class="text-sm text-slate-500">Menunggu</p><p class="mt-1 text-3xl font-bold text-sky-700">{{ $summary['waiting'] }}</p></div>
            <div class="rounded-lg border border-sky-100 bg-white p-4 shadow-sm"><p class="text-sm text-slate-500">Sedang Diproses</p><p class="mt-1 text-3xl font-bold text-sky-700">{{ $summary['processing'] }}</p></div>
            <div class="rounded-lg border border-sky-100 bg-white p-4 shadow-sm"><p class="text-sm text-slate-500">Selesai</p><p class="mt-1 text-3xl font-bold text-sky-700">{{ $summary['completed'] }}</p></div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-sky-100 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-sky-100 text-sm">
                <thead class="bg-sky-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">Pelapor</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">Telepon</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">Lokasi</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">Keterangan</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sky-100">
                    @forelse ($reports as $report)
                        <tr class="align-top text-slate-700">
                            <td class="px-4 py-3 font-medium">{{ $report->name }}</td>
                            <td class="px-4 py-3">{{ $report->phone }}</td>
                            <td class="px-4 py-3">{{ $report->address }}</td>
                            <td class="max-w-md px-4 py-3">{{ $report->description }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('laporan.status', $report) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" aria-label="Status laporan {{ $report->id }}" class="rounded-md border-sky-200 text-sm focus:border-sky-500 focus:ring-sky-500">
                                        @foreach (['Menunggu Verifikasi', 'Sedang Diproses', 'Selesai'] as $status)
                                            <option value="{{ $status }}" @selected($report->status === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="rounded-md bg-sky-600 px-3 py-2 text-xs font-semibold text-white hover:bg-sky-700">Simpan</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $report->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada laporan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $reports->links() }}</div>
    </div>
</x-app-layout>
