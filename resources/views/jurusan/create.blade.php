@extends('layouts.app')
 @section('content')

 <div class="pt-3">
 <h1 class="h2">Tambah Jurusan</h1>
 </div>
 <hr>

 <form method="POST" action="{{ route('jurusans.store') }}">
 @include('jurusan.form',['tombol' => 'Tambah'])
 </form>

 @endsection