<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        $author = Author::all();
        return view('admin.buku.index',compact('buku','author'));
    }
    
    public function edit($id)
    {
        $buku = Buku::find($id);
        $author = Author::all();
        return view('admin.buku.edit',compact('buku','author'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'=>'required',
            'judul'=>'required',
            'author_id'=>'required',
            'penerbit'=>'required',
            'tahun_terbit'=>'required',
            'stok'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }

        $foto = $request->file('foto');
        $nama_foto = time() . "_" . $foto->getClientOriginalName();
        $tujuan_upload_foto = 'gambar_buku';
        $foto->move($tujuan_upload_foto, $nama_foto);

        $buku = new Buku();
        $buku->kode = $request->kode;
        $buku->judul = $request->judul;
        $buku->author_id = $request->author_id;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->foto = $nama_foto;
        $buku->save();

        return redirect()->back()->with('success','Buku berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode'=>'required',
            'judul'=>'required',
            'author_id'=>'required',
            'penerbit'=>'required',
            'tahun_terbit'=>'required',
            'stok'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data!')->withInput()->withErrors($validator);
        }

        $buku = Buku::find($request->id);

        if($request->file('foto') != null)
        {
            $foto = $request->file('foto');
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $tujuan_upload_foto = 'gambar_buku';
            $foto->move($tujuan_upload_foto, $nama_foto);
        }
        else
        {
            $nama_foto = $buku->foto;
        }

        $buku->kode = $request->kode;
        $buku->judul = $request->judul;
        $buku->author_id = $request->author_id;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        $buku->foto = $nama_foto;
        $buku->save();

        return redirect('admin/buku')->with('success','Buku berhasil dirubah');
    }

    public function hapus($id)
    {
        Buku::find($id)->delete();
        return redirect('admin/buku')->with('success','Buku berhasil dihapus');
    }
}
