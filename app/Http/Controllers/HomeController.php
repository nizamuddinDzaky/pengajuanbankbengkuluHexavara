<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();

        if($user->userRole->role->role == 'AdminPusat'){
            return redirect('admin-pusat')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }

        else if($user->userRole->role->role == 'AdminCabang'){
            return redirect('admin-cabang')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }
        else if($user->userRole->role->role == 'AdminCabangPembantu'){
            return redirect('admin-cabang-pembantu')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }
        else if($user->userRole->role->role == 'CustomerService'){
            return redirect('customer-service')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }

        return view('home');
    }
}
