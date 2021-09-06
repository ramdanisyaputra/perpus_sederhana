<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.admin.index',compact('admin'));
    }
    
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.admin.edit',compact('admin'));
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

        Admin::create($request->all());

        return redirect()->back()->with('success','Admin berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'username'=>'required|unique:admin,username,'. $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('alert','Gagal mengubah data!')->withInput()->withErrors($validator);
        }

        $admin = Admin::find($request->id);
        $admin->username = $request->username;
        $admin->nama = $request->nama;
        $admin->save();

        return redirect('admin/admin')->with('success','Admin berhasil dirubah');
    }
}
