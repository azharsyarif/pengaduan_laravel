<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
            <h1 class="text-3xl font-semibold mb-6">Profil Petugas</h1>
    
            <div class="mb-4">
                <p><strong>Nama Petugas:</strong> {{ $petugas->nama_petugas }}</p>
                <p><strong>Username:</strong> {{ $petugas->username }}</p>
                <!-- Tambahkan informasi profil lainnya di sini -->
            </div>
    
            <!-- Tautan untuk mengedit profil atau melakukan tindakan lainnya -->
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Edit Profil</a>
        </div>
    @endsection
    

</body>