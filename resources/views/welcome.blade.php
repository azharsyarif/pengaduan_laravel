<!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    </head>
    <body>
    <section class="bg-white dark:bg-gray-900">
    <x-navbar />

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Pengaduan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Isi Laporan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris data -->
                    @foreach($pengaduans as $pengaduan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $pengaduan->tgl_pengaduan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->masyarakat_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->isi_laporan }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ $pengaduan->foto }}" alt="Foto Pengaduan">
                            </td>
                            <td class="px-6 py-4">
                                <button class="bg-blue-500 hover:bg-blue-700 transition text-white font-bold py-2 px-4 rounded">
                                    {{ $pengaduan->status }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <button class="bg-gray-600 hover:bg-gray-800 transition text-white font-bold py-2 px-4 rounded">
                                    action
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
