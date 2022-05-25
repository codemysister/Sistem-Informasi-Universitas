@extends('layouts.app')
 @section('content')

 <div class="container ">
 <div class="row">
 <div class="col-10 offset-1">

 <h1 class="display-4 text-center my-5">Pencarian</h1>

 <form action="{{ url('/pencarian/proses')}}" method="GET">
 @csrf
 <div class="input-group mb-3">
 <select class="form-select w-10" id="kategori" name="kategori">
 <option value="dosen"
 {{ ($kategori ?? '') == 'dosen' ? 'selected': ''}}>
 Dosen</option>
 <option value="mahasiswa"
 {{ ($kategori ?? '') == 'mahasiswa' ? 'selected': ''}}>
 Mahasiswa</option>
 <option value="matakuliah"
 {{ ($kategori ?? '') == 'matakuliah' ? 'selected': ''}}>
 Mata Kuliah</option>
 </select>
 <input type="text" class="form-control w-50"
 placeholder="Nama Dosen / Mahasiswa / Mata Kuliah"
 name="s" id="s" value="{{ $s ?? '' }}">
 <button type="submit" class="btn btn-primary">Search</button>
 </div>

 </form>

@isset($result)
 @if (count($result) == 0)
 {{-- Artinya pencarian tidak ditemukan --}}
 <h3 class="text-center my-5">Maaf, hasil tidak ditemukan...</h3>
 @else
 {{-- Tampilkan tabel hasil pencarian --}}
 <table class="table table-striped w-auto mx-auto mt-4" id="hasil">
 <thead>
 <tr>
 <th colspan="2" class="text-center">Hasil Pencarian</th>
 </tr>
 </thead>
 <tbody>
 <tr>
 @if ($kategori == 'dosen')
 @foreach ($result as $dosen)
 <tr>
 <th>{{$loop->iteration}}</th>
 <td><a href="{{ route('dosens.show',
 ['dosen' => $dosen->id]) }}">
 {{$dosen->nama}} ({{$dosen->nid }})</a>
 </td>

 </tr>
 @endforeach
 @elseif ($kategori == 'mahasiswa')
 @foreach ($result as $mahasiswa)
 <tr>
 <th>{{$loop->iteration}}</th>
 <td><a href="{{ route('mahasiswas.show',
 ['mahasiswa' => $mahasiswa->id]) }}">
 {{$mahasiswa->nama}} ({{ $mahasiswa->nim }})</a>
 </td>
 </tr>
 @endforeach
 @elseif ($kategori == 'matakuliah')
 @foreach ($result as $matakuliah)
 <tr>
 <th>{{$loop->iteration}}</th>
 <td><a href="{{ route('matakuliahs.show',
 ['matakuliah' => $matakuliah->id]) }}">
 {{$matakuliah->nama}} ({{$matakuliah->kode }})</a>
 </td>
 </tr>
 @endforeach
 @endif
 </tbody>
 </table>

 <div class="row">
 <div class="mx-auto mt-3">
 {{ $result->appends(['kategori' => $kategori,'s' => $s])
 ->fragment('hasil')->links() }}

 </div>
 </div>
 @endif
 @endisset

 </div>
 </div>
 </div>

 @endsection