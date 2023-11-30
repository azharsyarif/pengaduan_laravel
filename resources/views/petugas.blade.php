<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tanggapan</title>
    @vite('resources/css/app.css')

    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <section class="bg-white dark:bg-gray-900">
        <x-navbar />


<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Password
                </th>
                <th scope="col" class="px-6 py-3">
                    Nomor Telepon
                </th>
                <th scope="col" class="px-6 py-3">
                    Role
                </th>
            </tr>
            {{-- @foreach($tanggapans as $tanggapan)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $tanggapan->name }}</td>
                            <td class="px-6 py-4">{{ $tanggapan->email }}</td>
                            <td class="px-6 py-4">{{ $tanggapan->password }}</td>
                            <td class="px-6 py-4">{{ $tanggapan->no_telp }}</td>
                            <td class="px-6 py-4">{{ $tanggapan->role }}</td>
                </tr>
            @endforeach --}}
        </thead>
    </table>
</div>
            </section>
</body>