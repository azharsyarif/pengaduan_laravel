<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Pengaduan Table</title>
</head>
<body>
    <section class="bg-white dark:bg-gray-900">
        <x-navbar />

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal Pengaduan</th>
                        <th scope="col" class="px-6 py-3">NIK</th>
                        <th scope="col" class="px-6 py-3">Isi Laporan</th>
                        <th scope="col" class="px-6 py-3">Foto</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduans as $pengaduan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $pengaduan->tgl_pengaduan }}</td>
                            <td class="px-6 py-4">{{ $pengaduan->masyarakat_id }}</td>
                            <td class="px-6 py-4">{{ $pengaduan->isi_laporan }}</td>
                            <td class="px-6 py-4"><img src="{{ $pengaduan->foto }}" alt="Foto Pengaduan"></td>
                            @if ($pengaduan->status == 'baru')
                                <td class="border text-center">
                                    <button style="background-color: red; color: #111827;" class="px-4 py-2 rounded" disabled>
                                        <b>Menunggu Konfirmasi</b>
                                    </button>
                                </td>
                                <td class="border text-center">
                                    <form action="/update-konformasi/{{$pengaduan->id}}" method="post">
                                        {{ csrf_field() }}
                                        <button style="background-color: #404B69; color: #111827;" class="px-4 py-2 rounded">
                                            <b>ACCEPT</b>
                                        </button>
                                    </form>
                                </td>
                            @elseif ($pengaduan->status == 'proses')
                                <td>
                                    <button style="background-color: #31a1fd; color: #111827;" class="px-4 py-2 rounded" disabled>
                                        <b>Menunggu Tanggapan</b>
                                    </button>
                                </td>
                                <td class="border text-center">
                                    <a href="{{ route('form.tanggapan', ['pengaduan_id' => $pengaduan->id]) }}" style="text-decoration: none;">
                                        <button style="background-color: #404B69; color: #111827;" class="px-4 py-2 rounded"><b>RESPONSE</b></button>
                                    </a>                                    
                                    </a>
                                </td>
                            @elseif ($pengaduan->status == 'selesai')
                                <td>
                                    <button style="background-color: #00FF00; color: #111827;" class="px-4 py-2 rounded" disabled>
                                        <b>Selesai</b>
                                    </button>
                                </td>
                                <td class="border text-center">
                                    <button class="bg-gray-600 hover:bg-gray-800 transition text-white font-bold py-2 px-4 rounded">
                                        action
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
</body>
</html>
