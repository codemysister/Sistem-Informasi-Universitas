@csrf
 <div class="row mb-3">
 <label for="nim" class="col-md-3 col-form-label text-md-end"
 title="8 digit angka NIM">
 Nomor Induk Mahasiswa </label>
 <div class="col-md-4">
 <input id="nim" type="text"
 class="form-control @error('nim') is-invalid @enderror"
 name="nim" value="{{ old('nim') ?? $mahasiswa->nim ?? '' }}" autofocus

 placeholder="8 digit angka NIM, contoh: 10311492">
 @error('nim')
 <span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
 </div>

 <div class="row mb-3">
 <label for="nama" class="col-md-3 col-form-label text-md-end">
 Nama Mahasiswa </label>
 <div class="col-md-4">
 <input id="nama" type="text"
 class="form-control @error('nama') is-invalid @enderror"
 name="nama" value="{{ old('nama') ?? $mahasiswa->nama ?? '' }}">
 @error('nama')
 <span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
 </div>
 <div class="row mb-3">
    <label for="jurusan_id" class="col-md-3 col-form-label text-md-end">
        Jurusan </label>
     {{-- jurusan tidak bisa diubah jika ada mata kuliah yang sudah diambil --}}
 @if ( ($tombol=='Update') AND ($mahasiswa->matakuliahs->count() > 0) )
 <div class="col-md-9 d-flex align-items-center">
 <div>{{ $mahasiswa->jurusan->nama }}
 <small><i>(tidak bisa di ubah karena sudah mengambil
 {{ $mahasiswa->matakuliahs->count() }} mata kuliah)</i></small>
 </div>
 </div>
 {{-- Kirim nilai jurusan awal agar tidak bermasalah dengan validasi --}}
 <input type="hidden" name="jurusan_id" id="jurusan_id"
 value="{{$mahasiswa->jurusan_id}}">
 @else
 {{-- Untuk form create atau mahasiswa belum mengambil matakuliah --}}
 
 <div class="col-md-4">
 <select name="jurusan_id" id="jurusan_id"
 class="form-select @error('jurusan_id') is-invalid @enderror">
 @foreach ($jurusans as $jurusan)
 @if ($jurusan->id == (old('jurusan_id') ?? $dosen->jurusan_id ?? ''))
 <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama }}</option>
 @else
 <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
 @endif
 @endforeach
 </select>
 @error('jurusan_id')
 <span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
 @endif
 </div>

 {{-- Trik agar bisa kembali ke halaman yang klik --}}
 @isset($mahasiswa)
 <input type="hidden" name="url_asal"
 value="{{ old('url_asal') ?? url()->previous().'#row-'.$mahasiswa->id}}">
 @else
 <input type="hidden" name="url_asal"
 value="{{ old('url_asal') ?? url()->previous()}}">
 @endisset
 <div class="row">
 <div class="col-md-6 offset-md-3">
 <button type="submit" class="btn btn-primary">{{$tombol}}</button>
 </div>
 </div>
