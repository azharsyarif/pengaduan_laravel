<body>
    <h1>LAPORAN TANGGAPAN</h1>
    <p>Berikut adalah rangkuman laporan yang terlampir, mencakup inti dari tanggapan yang diberikan terhadap seluruh laporan yang telah diajukan.</p>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL PENGADUAN</th>
                    <th>NAMA    PELAPOR</th>
                    <th>ISI LAPORAN</th>
                    {{-- <th>FOTO</th> --}}
                    <th>TANGGAPAN</th>
                    <th>NAMA PETUGAS</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($tanggapan as $tanggapanItem)
                    @php
                        // Pastikan $pengaduan tidak null sebelum menggunakan where()
                        if($pengaduan) {
                            $pengaduanItem = \App\Models\Pengaduan::where('id', $tanggapanItem->id)->first();
                            // Lakukan operasi lainnya jika $pengaduan tidak null
                            // $user = \App\Models\Masyarakat::where('nik', $pengaduanItem->nik)->first();
                            
                            $petugas = \App\Models\User::find($tanggapanItem->id_petugas);
                        }
                    @endphp
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $tanggapanItem->tgl_pengaduan }}</td>
                        {{-- <td>{{ $user ? $user->name : 'User not found' }}</td>  --}}
                        {{-- <td>{{ $pengaduanItem->isi_laporan  }}</td> --}}
                        {{-- <td>
                            <div style="display: flex; justify-content: center; margin-top: 10px; margin-bottom: 10px;">
                                @if($pengaduanItem->foto)
                                <img src="{{ asset('storage/' . $pengaduanItem->foto) }}" alt="Pengaduan Photo" width="50">
                                @else
                                No Photo
                                @endif
                                <img src="data:image/jpeg;base64,{{ base64_encode($pengaduanItem->foto) }}" alt="avatar" class="imaged w64 rounded" />
                            </div>
                        </td> --}}
                        <td>{{ $tanggapanItem->tanggapan}}</td>
                        {{-- <td>{{ $petugas->name . ' (' . $petugas->role . ')' }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
