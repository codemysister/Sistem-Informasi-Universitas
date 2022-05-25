@extends('layouts.app')
 @section('content')

 <div class="pt-3">
 <h1 class="h2">Tambah Dosen</h1>
 </div>
 <hr>

 <form method="POST" action="{{ route('dosens.store') }}">
 @include('dosen.form',['tombol' => 'Tambah'])
 </form>

 @endsection