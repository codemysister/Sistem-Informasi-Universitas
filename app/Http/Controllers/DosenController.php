<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // Untuk membatasi hak akses
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::with('jurusan')->orderBy('nama')->paginate(5);
        return view('dosen.index', ['dosens' => $dosens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.create', compact('jurusans'));
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
            'nid' => 'required|alpha_num|size:8|unique:dosens,nid',
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);
        Dosen::create($validateData);
        Alert::success('Berhasil', "Dosen $request->nama berhasil dibuat");
        return redirect($request->url_asal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.edit', ['dosen' => $dosen, 'jurusans' => $jurusans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validateData = $request->validate([
            'nid' => 'required|alpha_num|size:8|unique:dosens,nid,' . $dosen->id,
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);
        $dosen->update($validateData);
        Alert::success('Berhasil', "Dosen $request->nama telah di update");
        // Trik agar halaman kembali ke awal
        return redirect($request->url_asal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        Alert::success('Berhasil', "Dosen $dosen->nama telah di hapus");
        return redirect("/dosens");
    }
}
