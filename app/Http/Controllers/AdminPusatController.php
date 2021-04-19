<?php

namespace App\Http\Controllers;

use App\Kabkot;
use App\Kantor;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\User;
use App\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;


class AdminPusatController extends Controller
{


    public function index()
    {
        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();
        $role = $user->userRole->role->role;
        return view('adminpusat.dashboard', compact('role'));
    }
}
