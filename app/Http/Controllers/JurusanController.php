<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // Untuk membatasi hak akses
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index', 'jurusanDosen', 'jurusanMahasiswa'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusans = Jurusan::withCount('mahasiswas')->orderBy('nama')->get();
        return view('jurusan.index', ['jurusans' => $jurusans]);
    }

    public function jurusanDosen($jurusan_id)
    {
        $dosens = Dosen::where('jurusan_id', $jurusan_id)->orderBy('nama')
            ->paginate(5);
        $nama_jurusan = Jurusan::find($jurusan_id)->nama;

        return view('dosen.index', [
            'dosens' => $dosens,
            'nama_jurusan' => $nama_jurusan,
        ]);
    }

    public function jurusanMahasiswa($jurusan_id)
    {
        $mahasiswas = Mahasiswa::where('jurusan_id', $jurusan_id)->orderBy('nama')
            ->paginate(5);
        $nama_jurusan = Jurusan::find($jurusan_id)->nama;
        return view('mahasiswa.index', [
            'mahasiswas' => $mahasiswas,
            'nama_jurusan' => $nama_jurusan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'kepala_jurusan' => 'required',
            'daya_tampung' => 'required|min:10|integer',
        ]);
        $jurusan = Jurusan::create($validateData);
        Alert::success('Berhasil', "Jurusan $request->nama berhasil dibuat");
        return redirect("/jurusans#card-{$jurusan->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'kepala_jurusan' => 'required',
            'daya_tampung' => 'required|min:10|integer',
        ]);

        $jurusan->update($validateData);
        Alert::success('Berhasil', "Jurusan $request->nama telah di update");
        return redirect("/jurusans#card-{$jurusan->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        Alert::success('Berhasil', "Jurusan $jurusan->nama telah di hapus");
        return redirect("/jurusans");
    }
}
