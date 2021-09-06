<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NonAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NonAdminController extends Controller
{
    public function index()
    {
        $non_admin = NonAdmin::all();
        return view('admin.non_admin.index',compact('non_admin'));
    }
    
    public function edit($id)
    {
        $non_admin = NonAdmin::find($id);
        return view('admin.non_admin.edit',compact('non_admin'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'username'=>'unique:admin',
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal menginput data')->withInput()->withErrors($validator);
        }

        NonAdmin::create($request->all());

        return redirect()->back()->with('success','Non Admin berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'username'=>'required|unique:non_admin,username,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data!')->withInput()->withErrors($validator);
        }

        $non_admin = NonAdmin::find($request->id);
        $non_admin->username = $request->username;
        $non_admin->nama = $request->nama;
        $non_admin->save();

        return redirect('admin/non_admin')->with('success','Non Admin berhasil dirubah');
    }
    
    public function hapus($id)
    {
        NonAdmin::find($id)->delete();
        return redirect('admin/non_admin')->with('success','Non Admin berhasil dihapus');

    }
}
