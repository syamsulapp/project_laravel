<?php

namespace App\Http\Controllers;

use App\CrudModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = new CrudModels();
        $kode_urut = $data->kode_urut();
        // syntax coding dibawah ini untuk menampilkan list data 
        return view('crud', [
            'list' => CrudModels::all(),
            'format' => $kode_urut
        ]);
        //sintaks diatas untuk mengirim data crud dan mengirim kode nrcs ke views 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $KostumError = [
            'required' => ':attribute jangan dikosongkan',
            'foto.image' => 'yang di upload harus gambar',
            'foto.mimes' => 'jenis gambar yang di upload harus jpg png atau jpeg',
            'foto.max' => 'gambar yang di upload tidak boleh melebihi 256 Kb',
            'nim.unique' => 'nim yang anda masukan sudah pernah dimasukan sebelumnya'
        ];
        $request->validate([
            'nim' => 'required|max:9|unique:crud',
            'nama' => 'required',
            'email' => 'required|email|unique:crud',
            'jurusan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:256',
        ], $KostumError);
        // upload foto 
        if ($request->hasFile('foto')) {
            $foto = $request->foto;
            $jenis_file = $foto->extension();
            $nama_gambar = date('dmyHis') . '.' . $jenis_file;
            Storage::putFileAs('public/foto', $request->file('foto'), $nama_gambar);
        } else {
            $nama_gambar = "tidak Di Upload";
        }
        // $debug = [
        //     'nim' => $request->nim,
        //     'nama' => $request->nama,
        //     'email' => $request->email,
        //     'jurusan' => $request->jurusan,
        //     'file' => $path,
        // ];
        // dd($debug);
        CrudModels::create([
            'nim' => $request->nim,
            'nrcs' => $request->nrcs,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'foto' => $nama_gambar,
        ]);

        return redirect('/crud')->with('flash', 'sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrudModels  $crudModels
     * @return \Illuminate\Http\Response
     */
    public function show(CrudModels $crudModels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrudModels  $crudModels
     * @return \Illuminate\Http\Response
     */
    public function edit(CrudModels $crudModels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrudModels  $crudModels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrudModels $crudModels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CrudModels  $crudModels
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrudModels $crudModels)
    {
        //
    }
}
