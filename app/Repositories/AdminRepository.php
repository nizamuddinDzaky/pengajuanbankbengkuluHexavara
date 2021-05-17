<?php
    namespace App\Repositories;

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

    public function get_title_card()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return "Kantor Pusat";
        }else if($this->get_role_admin() == 'AdminCabang'){
            return "Kantor Cabang";
        }else if($this->get_role_admin() == 'AdminCabangPembantu'){
            return "Kantor Cabang Pembantu";
        }
        return "";
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
        }else if($this->get_role_admin() == 'AdminCabangPembantu'){
            return route('admin.cabang_pembantu.form.add.cs');
        }
    }

    public function get_url_submit_form_add_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return route('admin.pusat.add.cs');
        }else if($this->get_role_admin() == 'AdminCabang'){
            return route('admin.cabang.add.cs');
        }else if($this->get_role_admin() == 'AdminCabangPembantu'){
            return route('admin.cabang_pembantu.add.cs');
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
        }else if($this->get_role_admin() == 'AdminCabangPembantu'){
            return route('admin.cabang_pembantu.edit.cs');
        }
    }

    public function get_param_route_edit_status_cs()
    {
        if($this->get_role_admin() == 'AdminPusat'){
            return 'admin.pusat.edit.status.cs';
        }else if($this->get_role_admin() == 'AdminCabang'){
            return 'admin.cabang.edit.status.cs';
        }else if($this->get_role_admin() == 'AdminCabangPembantu'){
            return 'admin.cabang_pembantu.edit.status.cs';
        }
    }

    public function get_list_cs($kantor_id)
    {

        $customer_service = User::select('users.*')->join('user_role', 'user_role.user_id', '=', 'users.id')->where('user_role.role_id', 4);
        if($kantor_id){
            $customer_service = $customer_service->where('kantor_id', '=', $kantor_id);
        }
        return $customer_service->get();
    }
}
?>