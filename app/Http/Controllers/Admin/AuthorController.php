<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::all();
        return view('admin.author.index',compact('author'));
    }
    
    public function edit($id)
    {
        $author = Author::find($id);
        return view('admin.author.edit',compact('author'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'tanggal_lahir'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }

        Author::create($request->all());

        return redirect()->back()->with('success','Admin berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'tanggal_lahir'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data!')->withInput()->withErrors($validator);
        }

        $author = Author::find($request->id);
        $author->nama = $request->nama;
        $author->alamat = $request->alamat;
        $author->tanggal_lahir = $request->tanggal_lahir;
        $author->telp = $request->telp;
        $author->save();

        return redirect('admin/author')->with('success','Author berhasil dirubah');
    }

    public function hapus($id)
    {
        Buku::where('author_id',$id)->delete();
        Author::find($id)->delete();

        return redirect('admin/author')->with('success','Author berhasil dihapus');

    }
}
