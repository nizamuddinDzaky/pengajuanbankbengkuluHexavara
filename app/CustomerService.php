<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    protected $table = 'cs';

    public function type_cs()
    {
        return $this->belongsTo(TypeCs::class, 'type_cs_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function str_status()
    {
        if($this->user->is_active == '0'){
            return '<span class="badge badge-danger"> Tidak Aktif</span>';
        }else{
            return '<span class="badge badge-success"> Aktif</span>';
        }
    }

    public function url_form_edit($role)
    {
        if($role == 'AdminPusat'){
            return route('admin.pusat.form.edit.cs', ['id' => $this->id]);
        }else{
            return route('admin.cabang.form.edit.cs', ['id' => $this->id]);
        }
    }

    public function param_route_edit_status()
    {
        if($this->user->is_active == '0'){
            return ['id_cabang' => $this->id, 'next_status'=> 1];
        }else{
            return ['id_cabang' => $this->id, 'next_status'=> 0];
        }
    }

    public function str_change_staus()
    {
        if($this->user->is_active == '0'){
            return 'Aktifkan';
        }else{
            return 'Hapus';
        }
    }
}
