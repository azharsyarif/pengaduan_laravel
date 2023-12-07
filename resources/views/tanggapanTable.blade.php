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
       <a href="{{ route('generate.tanggapan')}}">
        <button type="button" class="mx-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">GENERATE</button>
    </a>
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