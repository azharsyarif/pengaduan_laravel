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
        <!-- Navbar or any other header -->
        
        <div class="relative overflow-x-auto">
            <h1 class="mx-auto my-10 text-white text-center text-xl font-bold">TANGGAPAN</h1>
            <form class="max-w-sm mx-auto" method="POST" action="/add-tanggapan">
                @csrf
                <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}" id="">
                <input type="hidden" name="id" value="{{ Auth::user()->id }}" id="">
                
                <div class="mb-5">
                    <textarea name="tanggapan" placeholder="Isi Tanggapan..." id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <button type="submit" class="text-white bg-slate-600 hover:bg-slate-900 transition focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
            </form>
            
            <!-- Show Pengaduan Information -->
            <div class="max-w-3xl mx-auto p-4">
    @if($pengaduan)
        <h2 class="text-2xl font-bold text-center my-10 text-white">Data Pengaduan</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-white">Judul</th>
                    <th class="px-6 py-3 text-white">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-6 py-4 text-white">ID Pengaduan</td>
                    <td class="px-6 py-4 text-white">{{ $pengaduan->id }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 text-white">Tanggal Pengaduan</td>
                    <td class="px-6 py-4 text-white">{{ $pengaduan->tgl_pengaduan }}</td>
                </tr>
                <!-- Add more rows for other information -->
            </tbody>
        </table>
    @else
        <p class="text-center">Data pengaduan tidak ditemukan.</p>
    @endif
</div>
    </section>
</body>
</html>
