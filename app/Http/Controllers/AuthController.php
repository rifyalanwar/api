<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Transformers\UserTransformer;
use App\User;
use App\Admin;

class AuthController extends Controller
{
    public function login(){
        return view('admin/auth/login');
    }

    public function loginPost(Request $request){
        if(!auth()->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect('/')->with('gagal','Gagal login, pastikan data yang anda masukkan benar');
        }else{
            // return "Berhasil";
            return redirect('/beranda')->with('sukses',' Selamat Datang Admin');
        }
    }
    public function register(){
        return view('admin/auth/register');
    }

    public function registerPost(Request $request){
        $token = Str::random(40);
        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'token' => $token
        ]);
        return redirect('/')->with('Akun Berhasil Dibuat');
        
    }

    public function MemberRegister(Request $request)
    {
    //    return $request;
        $config = [
            'table' => 'users',
            'field' => 'id_member',
            'length' => 7,
            'prefix' => 'UP-'
        ];

        $id_member = IdGenerator::generate($config);
        $password = bcrypt($id_member);
        $token = Str::random(40);
        $sql = User::create([
            'id_member' => $id_member,
            'id_upline' => $request->id_upline,
            'nama' => $request->nama,
            'nomer_hp' => $request->nomer_hp,
            'rekening' => $request->rekening,
            'alamat' => $request->alamat,
            'foto' => $request->foto,
            'password' => $password,
            'token' => $token
        ]);
        return response()->json(['Success' => 'Berhasil Daftar', 'code' => 200]);
    }

    public function MemberLogin(Request $request, User $user)
    {
        // return $request;
        if(!auth()->attempt(['id_member' => $request->username, 'password' => $request->password])){  
            return response()->json(['Error' => 'Gagal Login', 'code' => 401]);
        }
        $user = $user->find(Auth::user()->id);
        return $data = fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->token,
            ])
            ->toArray();
        return response()->json(['Success' => 'Berhasil Login', 'code' => 200]);
    }

    public function MemberLogout()
    {
        auth()->logout();
        // return 'tes'.Auth::User();
        return response()->json(['Success' => 'Berhasil Logout', 'code' => 200]);
    }
}
