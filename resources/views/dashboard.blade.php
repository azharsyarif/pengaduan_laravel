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
            <table id="pengaduan-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 tanggal-pengaduan-header">Tanggal Pengaduan</th>
                        <th scope="col" class="px-6 py-3">NIK</th>
                        <th scope="col" class="px-6 py-3">Isi Laporan</th>
                        <th scope="col" class="px-6 py-3">Foto</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduans as $pengaduan)
                    @php
                        $role = Auth::user()->role;
                        $cate = $pengaduan->kategori;
                    @endphp                        
                    @if ($role == 'admin' || $role == $cate)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $pengaduan->tgl_pengaduan }}</td>
                        <td class="px-6 py-4">{{ $pengaduan->tgl_pengaduan }}</td>
                        <td class="px-6 py-4">{{ $pengaduan->isi_laporan }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" width="100px" class="imaged w64 rounded" />
                            </td>
                            <td class="px-6 py-4">{{ $pengaduan->kategori}}</td>
                            @if ($pengaduan->status == 'baru')
                                <td class="border text-center">
                                    <button class="bg-yellow-600 transition text-white py-2 px-4 rounded" disabled>
                                        <b>Menunggu Konfirmasi</b>
                                    </button>
                                </td>
                                <td class="border text-center">
                                    <form action="/update-konformasi/{{$pengaduan->id}}" method="post">
                                        {{ csrf_field() }}
                                        <button class="bg-gray-600 hover:bg-gray-800 transition text-white font-bold py-2 px-4 rounded">
                                            <b>ACCEPT</b>
                                        </button>
                                    </form>
                                </td>
                            @elseif ($pengaduan->status == 'proses')
                                <td class="border text-center">
                                    <button class=" bg-blue-500 transition text-black font-semibold py-2 px-4 rounded" disabled>
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
                                <td class="text-center">
                                    <button style=" background-color: #00FF00; color: #111827;" class="px-4 py-2 rounded" disabled>
                                        <b>Selesai</b>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-footer />
    </section>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
<script>
    const datepicker = new Datepicker(document.querySelector('.datepicker'), {
        // Atur opsi datepicker sesuai kebutuhan
        // Contoh konfigurasi opsi:
        // format: 'yyyy-mm-dd',
        // language: 'en'
    });
</script>
    
</body>
</html>
