<?php
    namespace App\Repositories;

use App\CustomerService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRepository
{
    function __construct(){}

    public function get_url_tambah_cabang()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.form.add.cabang', ['id_parent' =>  1]);
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.form.add.cabang', ['id_parent' =>  Auth::user()->id]);
        }
    }

    public function get_role_admin()
    {
        $user = User::with('userRole.role')->where('id', Auth::user()->id)->first();
        return $user->userRole->role->role;
    }

    public function get_param_route_edit_status_cabang()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return 'admin.pusat.edit.status.cabang';
        }else{
            return 'admin.cabang.edit.status.cabang';
        }
    }

    public function get_url_submit_form_add_cabang()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.add.cabang');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.add.cabang');
        }
    }

    public function get_url_submit_form_edit_cabang()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.edit.cabang');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.edit.cabang');
        }
    }

    public function get_url_tambah_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.form.add.cs');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.form.add.cs');
        }
    }

    public function get_url_submit_form_add_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.add.cs');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.add.cs');
        }
    }

    public function get_url_filter_list_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.cs');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.cs');
        }
    }

    public function get_url_submit_form_edit_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.edit.cs');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.edit.cs');
        }
    }

    public function get_param_route_edit_status_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return 'admin.pusat.edit.status.cs';
        }else if($this->get_role_admin() == 'AdminCabang'){
            return 'admin.cabang.edit.status.cs';
        }
    }

    public function get_list_cs($request)
    {
        $customer_service = [];
        if($request->kantor_id){
            $customer_service = CustomerService::select('cs.*')
                                                ->join('users', 'users.id', '=', 'cs.user_id')
                                                ->where('kantor_id', '=', $request->kantor_id)
                                                ->get();
        }else{
            if($this->get_role_admin() == 'AdminPusat'){
                $customer_service = CustomerService::all();
            }else{
                $customer_service = CustomerService::select('cs.*')
                ->join('users', 'users.id', '=', 'cs.user_id')
                ->where('kantor_id', '=', Auth::user()->kantor_id)
                ->get();
            }
        }
        return $customer_service;
    }
}
?>