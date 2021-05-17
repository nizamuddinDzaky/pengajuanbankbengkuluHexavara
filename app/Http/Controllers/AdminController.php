<?php

namespace App\Http\Controllers;

use App\CustomerService;
use App\Repositories\AdminRepository;

// use AdminRepository;
use App\User;
use App\Kantor;
use App\Kecamatan;
use App\Kelurahan;
use App\Provinsi;
use App\Kabkot;
use App\TypeCs;
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

    function __construct(
        AdminRepository $adminRepository
    ){
        $this->adminRepository = $adminRepository;
    }

    public function dashboard()
    {
       $role = $this->adminRepository->get_role_admin(); 
        return view('adminpusat.dashboard', compact('role'));
    }

    public function list_cabang()
    {
        $parent = 1 ;
        $url_add_form = $this->adminRepository->get_url_tambah_cabang();
        $role = $this->adminRepository->get_role_admin();
        $param_route_edit_status_cabang = $this->adminRepository->get_param_route_edit_status_cabang();

        $cabang = Kantor::where('parent', Auth::user()->kantor_id)->get();

        $cabangPembantu = Kantor::where('parent', '!=', 1)->where('parent' ,'!=', 0)->get();
        
        return view('adminpusat.list_cabang', compact('role',  'cabang', 'cabangPembantu', 'url_add_form', 'param_route_edit_status_cabang'));
    }

    public function form_add_cabang($id_parent)
    {
        $role = $this->adminRepository->get_role_admin();

        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $url_post = $this->adminRepository->get_url_submit_form_add_cabang();

        $cabang = Kantor::where('parent', 1)->get();

        $view = view('adminpusat.form_add_cabang', compact('provinsi', 'kabkot', 'kecamatan', 'kelurahan' , 'id_parent', 'url_post', 'cabang'))->render();
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

    public function form_edit_cabang(Request $request)
    {
        $role = $this->adminRepository->get_role_admin();
        
        // echo "asd";die;
        
        $url_post = $this->adminRepository->get_url_submit_form_edit_cabang();

        $provinsi = Provinsi::all();
        $kabkot = Kabkot::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        $cabang = Kantor::where('id', $request->id)->first();

        $list_cabang = Kantor::where('parent', 1)->get();
        $view = view('adminpusat.form_edit_cabang', compact('provinsi', 'kabkot', 'kecamatan', 'kelurahan' , 'cabang', 'list_cabang', 'url_post', 'role'))->render();
        return response()->json([
            'view' => $view,
        ]);
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
                'id' => 'required',
                'name_account' => 'required|max:255',
                'email_account' =>'required|max:255',
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

            if($request->has('parent')){
                $kantor->parent = $request->parent;
            }

            $user = User::find($kantor->admin->id);
            $user->name = $request->name_account;
            $user->email = $request->email_account;
            
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }

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

    public function detail_kantor ($id_kantor)
    {
        $role = $this->adminRepository->get_role_admin();

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

    public function edit_status_cabang($id_kantor, $next_status)
    {
        DB::beginTransaction();
        try {
            $kantor = Kantor::find($id_kantor);
            $kantor->is_active = $next_status;

            $user = User::find($kantor->admin->id);
            $user->is_active = $next_status;

            if(!$kantor->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return  back()->with(['success' => 'Berhasil Menyimpan Data']);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function list_cs(Request $request)
    {
        $role = $this->adminRepository->get_role_admin(); 
        $url_add_form = $this->adminRepository->get_url_tambah_cs();
        $url_filter_cs = $this->adminRepository->get_url_filter_list_cs();
        $param_route_edit_status_cs = $this->adminRepository->get_param_route_edit_status_cs();
        $cabang = Kantor::where('parent', '=', 1)->get();
        $cabang_pembantu = Kantor::where('parent' ,'!=', 0);

        if($role == 'AdminPusat'){
            $cabang_pembantu = $cabang_pembantu->where('parent', '!=', 1)->get();
        }else{
            $cabang_pembantu = $cabang_pembantu->where('parent', '=',  Auth::user()->kantor_id)->get();
        }

        $customer_service = $this->adminRepository->get_list_cs($request);
        
        return view('adminpusat.list_cs', compact('cabang', 'cabang_pembantu', 'url_add_form', 'customer_service', 'role', 'url_filter_cs', 'param_route_edit_status_cs'));
    }

    public function form_add_cs()
    {
        $url_post = $this->adminRepository->get_url_submit_form_add_cs();
        $type_cs = TypeCs::all();
        $cabang = Kantor::find(Auth::user()->kantor_id);
        $default_password = 'password';
        $view = view('adminpusat.form_add_cs', compact('type_cs', 'cabang', 'default_password', 'url_post') )->render();
        return response()->json([
            'view' => $view,
        ]);
    }

    public function add_cs(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name_cs' => 'required|max:255',
                'email_cs' =>'required|max:255',
                'type_cs' =>'required|max:255',
                'password' =>'required|max:255',
            ]);
            
            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $user = new User;
            $user->name = $request->name_cs;
            $user->email = $request->email_cs;
            $user->kantor_id = Auth::user()->kantor_id;
            $user->password = Hash::make($request->password);
            $user->is_active = 1;
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            $userRole = new UserRole;
            $userRole->user_id = $user->id;
            $userRole->role_id = 4;
            if(!$userRole->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            $cs = new CustomerService;
            $cs->user_id = $user->id;
            $cs->type_cs_id = $request->type_cs;
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

    public function form_edit_cs(Request $request)
    {
        $cs = CustomerService::find($request->id);
        $url_post = $this->adminRepository->get_url_submit_form_edit_cs();
        $type_cs = TypeCs::all();
        $cabang = Kantor::find($cs->user->kantor_id);
        $view = view('adminpusat.form_edit_cs', compact('cs', 'url_post', 'type_cs', 'cabang'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }

    public function edit_cs(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $validator = Validator::make($request->all(), [
                'name_cs' => 'required|max:255',
                'email_cs' =>'required|max:255',
                'type_cs' =>'required|max:255',
            ]);

            if ($validator->fails()){
                throw new Exception($validator->errors()->first());
            }

            $cs = CustomerService::find($request->id);
            $cs->type_cs_id = $request->type_cs;

            $user = User::find($cs->user_id);
            $user->name = $request->name_cs;
            $user->email = $request->email_cs;

            if(!$cs->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }
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
    public function edit_status_cs($id_cs, $next_status)
    {
        DB::beginTransaction();
        try {
            
            $cs = CustomerService::find($id_cs);

            $user = User::find($cs->user_id);
            $user->is_active = $next_status;
            
            if(!$user->save()){
                throw new Exception("Gagal Menyimpan data");
            }

            DB::commit();
            return  back()->with(['success' => 'Berhasil Menyimpan Data']);
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

    

}
