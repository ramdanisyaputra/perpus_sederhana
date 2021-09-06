<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function index()
    {
        return view('admin.ganti_password.index');
    }
    public function ganti_password(Request $request)
    {
        $auth = Auth::guard(session()->get('role'))->user();
            if (!(Hash::check($request->current_password, $auth->password))) {
            // The passwords matches
            return redirect()->back()->with("alert","Password lama tidak sesuai ");
            }
            if(!(strcmp($request->new_password, $request->new_password_confirmation)) == 0){
                        //New password and confirm password are not same
                        return redirect()->back()->with("error","Password baru dan konfirmasi password baru harus sama.");
            }
            $user = Admin::find($auth->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->back()->with("success","Password berhasil diubah !");
    }
}
