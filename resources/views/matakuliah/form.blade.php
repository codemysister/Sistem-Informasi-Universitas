@csrf
 <div class="row mb-3">
 <label for="kode" class="col-md-3 col-form-label text-md-end"
 title="5 digit kode mata kuliah">
 Kode Mata Kuliah </label>
 <div class="col-md-4">
 <input name="kode" id="kode" type="text" autofocus
 class="form-control @error('kode') is-invalid @enderror"
 value="{{ old('kode') ?? $matakuliah->kode ?? '' }}"
 placeholder="5 kode mata kuliah, contoh: IX264">
 @error('kode')
 <span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
 </span>
 @enderror
 </div>
 </div>

 <div class="row mb-3">
     <label for="nama" class="col-md-3 col-form-label text-md-end">
     Nama Mata Kuliah </label>
     <div class="col-md-4">
     <input name="nama" id="nama" type="text"
     class="form-control @error('nama') is-invalid @enderror"
     value="{{ old('nama') ?? $matakuliah->nama ?? '' }}">
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
 @if ( ($tombol=='Update') AND ($matakuliah->mahasiswas->count() > 0) )
 <div class="col-md-9 d-flex align-items-center">
 <div>{{ $matakuliah->jurusan->nama }}
 <small><i>(tidak bisa di ubah karena sudah diambil
 {{ $matakuliah->mahasiswas->count() }} mahasiswa)</i></small>
 </div>
 </div>
 {{-- Kirim nilai jurusan awal agar tidak bermasalah dengan validasi --}}
 <input type="hidden" name="jurusan_id" id="jurusan_id"
 value="{{$matakuliah->jurusan_id}}">
 @else
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
    
     <div class="row mb-3">
        <label for="dosen_id" class="col-md-3 col-form-label text-md-end">
        Dosen Pengajar </label>
     {{-- Pemeriksaan kondisi agar pilihan dosen tidak bisa diubah,
 Ini akan aktif jika form diakses dari dosens.show / halaman biodata --}}
 @if (isset($dosen))
 <div class="col-md-4 d-flex align-items-center">
 <div>{{ $dosen->nama}}</div>
 </div>
 {{-- Kirim id dosen ke form awal agar tidak bermasalah dengan validasi --}}
 @else
     
     <div class="col-md-4">
     <select name="dosen_id" id="dosen_id"
     class="form-select @error('dosen_id') is-invalid @enderror">
     @foreach ($dosens as $dosen)
     @if($dosen->id == (old('dosen_id') ?? $matakuliah->dosen->id ?? ''))
     <option value="{{ $dosen->id }}" selected>{{ $dosen->nama }}</option>
     @else
     <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
     @endif
     @endforeach
     </select>
     @error('dosen_id')
     <span class="invalid-feedback" role="alert">
     <strong>{{ $message }}</strong>
    </span>
 @enderror
     </div>
     
     @endif
    </div>    
     <div class="row mb-3">
     <label for="jumlah_sks" class="col-md-3 col-form-label text-md-end">
     Jumlah SKS </label>
     <div class="col-md-4">
     <select name="jumlah_sks" id="jumlah_sks"
     class="form-select @error('jumlah_sks') is-invalid @enderror">
     @for ($i = 1; $i <= 6; $i++)
     @if($i == (old('jumlah_sks') ?? $matakuliah->jumlah_sks ?? ''))
     <option value="{{ $i }}" selected>{{ $i }}</option>
     @else
     <option value="{{ $i }}">{{ $i }}</option>
     @endif
     @endfor
     </select>
     @error('jumlah_sks')
     <span class="invalid-feedback" role="alert">
     <strong>{{ $message }}</strong>
     </span>
     @enderror
     </div>
     </div>
    
     {{-- Trik agar bisa kembali ke halaman yang klik --}}
     @isset($matakuliah)
     <input type="hidden" name="url_asal"
     value="{{ old('url_asal') ?? url()->previous().'#row-'.$matakuliah->id}}">
     @else
     <input type="hidden" name="url_asal"
     value="{{ old('url_asal') ?? url()->previous()}}">
     @endisset
    
     <div class="row">
     <div class="col-md-6 offset-md-3">
     <button type="submit" class="btn btn-primary">{{$tombol}}</button>
     </div>
     </div>