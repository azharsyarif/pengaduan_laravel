<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Table Tanggapan</title>
</head>
<body>
    <section class="bg-white dark:bg-gray-900">
        <x-navbar />
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nomor</th>
                        <th scope="col" class="px-6 py-3">Tanggal Tanggapan</th>
                        <th scope="col" class="px-6 py-3">Tanggapan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tanggapans as $tanggapan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $tanggapan->pengaduan_id }}</td>
                            <td class="px-6 py-4">{{ $tanggapan->tgl_pengaduan }}</td>
                            <td class="px-6 py-4">{{ $tanggapan->tanggapan }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</body>