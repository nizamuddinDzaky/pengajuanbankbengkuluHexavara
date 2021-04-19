<?php

namespace App\Http\Controllers;

use App\User;
use App\Kantor;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\Kabkot;
use App\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;
use Symfony\Component\VarDumper\VarDumper;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();
        $role = $user->userRole->role->role;
        return view('adminpusat.dashboard', compact('role'));
    }

    public function list_cabang()
    {
        $parent = 1 ;
        $url = route('admin.pusat.form.add.cabang', ['id_parent' =>  1]);

        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();
        $role = $user->userRole->role->role;

        if($role != 'AdminPusat'){
            $parent = $user->kantor_id;
            $url = route('admin.cabang.form.add.cabang', ['id_parent' =>  $user->kantor_id]);
        }

        $kantor = Kantor::with('children')->where('parent', $parent)->get();
        // print_r($kantor);die;
        return view('adminpusat.list_cabang', compact('role', 'kantor', 'url'));
    }

    public function form_add_kantor($id_parent)
    {
        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();
        $role = $user->userRole->role->role;

        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        if($role != 'AdminPusat'){
            $url_post = route('admin.cabang.add.cabang');
        }else{
            $url_post = route('admin.pusat.add.cabang');
        }

        $view = view('adminpusat.form_add_kantor', compact('provinsi', 'kabkot', 'kecamatan', 'kelurahan' , 'id_parent', 'url_post'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }

    public function add_cabang(Request $request)
    {
        // $this->validate($request,);
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'address' => 'required|max:255',
                'provinsi' =>  'required',
                'kabkot' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'email_account'=> 'required',
                'name_account'=> 'required',
            ]);
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }
            $kantor = new Kantor;
            $kantor->nama_kantor =  $request->name;
            $kantor->parent =  $request->parent;
            $kantor->alamat =  $request->address;
            $kantor->provinsi_id =  $request->provinsi;
            $kantor->kabkot_id =  $request->kabkot;
            $kantor->kecamatan_id = $request->kecamatan;
            $kantor->kelurahan_id = $request->kelurahan;
            // $kantor->start_service =  date("H:i:s", strtotime($request->start_service));
            // $kantor->end_service =  date("H:i:s", strtotime($request->end_service));
            // $kantor->duration_service =  $request->duration_servic;
            if(!$kantor->save()){
                throw new Exception("Gagal Menyimpan data");
            }
    
            $user = new User;
            $user->name = $request->name_account;
            $user->email = $request->email_account;
            $user->password = Hash::make('password');
            $user->kantor_id = $kantor->id;
            $user->provinsi_id = $request->provinsi;
            $user->kabkot_id = $request->kabkot;
            $user->kecamatan_id = $request->kecamatan;
            $user->kelurahan_id = $request->kelurahan;
            $user->is_active = 1;
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }
    
            $userRole = new UserRole;
            $userRole->user_id = $user->id;
            $userRole->role_id = $kantor->parent == 1 ? '2' : '3';
            if(!$userRole->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::to('admin-pusat/list_cabang')->with(['error' => $e->getMessage()]);
        }
    }

    public function detail_kantor ($id_kantor)
    {
        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();
        $role = $user->userRole->role->role;

        $kantor = Kantor::with('children', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan')->where('id', $id_kantor)->first();
        
        if(!$kantor->children->isEmpty()){
            $role_id = 2;
        }else{
            $role_id = 3;
        }

        $customer_service = User::with('userRole')
        -> select("users.*")
        ->join('user_role', 'users.id', '=', 'user_role.user_id')
        ->where('kantor_id' , '=', $id_kantor)->where('role_id' , '=', 4)->get();
        
        $account_admin = User::with('userRole')
        ->select('users.*')
        ->join('user_role', 'users.id', '=', 'user_role.user_id')
        ->where('users.kantor_id' , '=', $id_kantor)->where('role_id' , '=', $role_id)->first();

        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('adminpusat.detail_kantor', compact('role', 'kantor', 'customer_service', 'account_admin', 'provinsi', 'kabkot', 'kecamatan', 'kelurahan'));
    }

    public function edit_status_kantor($id_kantor, $next_status)
    {
        DB::beginTransaction();
        try {
            $kantor = Kantor::find($id_kantor);
            $kantor->is_active = $next_status;
            
            if(!$kantor->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return  back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_cabang(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'address' => 'required|max:255',
                'provinsi' =>  'required',
                'kabkot' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'id' => 'required'
            ]);
                
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $kantor = Kantor::find($request->id);
            
            $kantor->nama_kantor = $request->name;
            $kantor->alamat = $request->address;
            $kantor->provinsi_id = $request->provinsi;
            $kantor->kabkot_id = $request->kabkot;
            $kantor->kecamatan_id = $request->kecamatan;
            $kantor->kelurahan_id = $request->kelurahan;
            if(!$kantor->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_account_cabang(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $validator = Validator::make($request->all(), [
                'name_account' => 'required|max:255',
                'email_account' =>'required|max:255',
            ]);

            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }
            

            $user = User::find($request->id);
            $user->name = $request->name_account;
            $user->email = $request->email_account;
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }
            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);

        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function add_cs(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name_cs' => 'required|max:255',
                'email_cs' =>'required|max:255',
                'address_cs' =>'required|max:255',
                'provinsi_cs' =>'required|max:255',
                'kabkot_cs' =>'required|max:255',
                'kecamatan_cs' =>'required|max:255',
                'kelurahan_cs' =>'required|max:255',
            ]);

            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $cs = new User;
            $cs->name = $request->name_cs;
            $cs->email = $request->email_cs;
            $cs->password = Hash::make('password');
            $cs->kantor_id = $request->id_kantor;
            $cs->alamat = $request->address_cs;
            $cs->provinsi_id = $request->provinsi_cs;
            $cs->kabkot_id = $request->kabkot_cs;
            $cs->kecamatan_id = $request->kecamatan_cs;
            $cs->kelurahan_id = $request->kelurahan_cs;
            $cs->is_active = 1;
            if(!$cs->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            $userRole = new UserRole;
            $userRole->user_id = $cs->id;
            $userRole->role_id = 4;
            if(!$userRole->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);

        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_status_cs($id_cs, $next_status)
    {
        DB::beginTransaction();
        try {
            $cs = User::find($id_cs);
            $cs->is_active = $next_status;
            
            if(!$cs->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return  back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function reset_password($id_account)
    {
        DB::beginTransaction();
        try {
            $account = User::find($id_account);
            $account->password = Hash::make('password');

            if(!$account->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return  back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit_cs(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name_cs' => 'required|max:255',
                'email_cs' =>'required|max:255',
                'address_cs' =>'required|max:255',
                'provinsi_cs' =>'required|max:255',
                'kabkot_cs' =>'required|max:255',
                'kecamatan_cs' =>'required|max:255',
                'kelurahan_cs' =>'required|max:255',
                'id_cs' =>  'required|max:255'
            ]);

            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $cs = User::find( $request->id_cs);;
            $cs->name = $request->name_cs;
            $cs->email = $request->email_cs;
            $cs->alamat = $request->address_cs;
            $cs->provinsi_id = $request->provinsi_cs;
            $cs->kabkot_id = $request->kabkot_cs;
            $cs->kecamatan_id = $request->kecamatan_cs;
            $cs->kelurahan_id = $request->kelurahan_cs;
            // print_r($cs);die;
            // $cs->is_active = 1;
            if(!$cs->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return back()->with(['success' => 'Berhasil Menyimpan Data']);

        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

}
