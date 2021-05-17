<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    protected $table = 'kantor';
    protected $guarded = [];

    // protected $appends = [
    //     'url'
    // ];

    function children(){
        return $this->hasMany(Kantor::class, 'parent');
    }

    public function parent() {
        return $this->belongsTo(Kantor::class,'parent');
    }

    public function provinsi() {
        return $this->belongsTo(Provinsi::class,'provinsi_id');
    }

    public function kabupaten() {
        return $this->belongsTo(Kabkot::class,'kabkot_id');
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class,'kecamatan_id');
    }

    public function kelurahan() {
        return $this->belongsTo(Kelurahan::class,'kelurahan_id');
    }

    public function url_detail()
    {
        return "asd";
    }

    public function admin()
    {
        return $this->hasOne(User::class)->join('user_role', 'users.id', '=', 'user_role.user_id')->whereIn('user_role.role_id' , [1,2,3]);
    }

    public function str_status()
    {
        if($this->is_active == '0'){
            return '<span class="badge badge-danger"> Tidak Aktif</span>';
        }else{
            return '<span class="badge badge-success"> Aktif</span>';
        }
    }

    public function str_change_staus()
    {
        if($this->is_active == '0'){
            return 'Aktifkan';
        }else{
            return 'Hapus';
        }
    }

    public function param_route_edit_status()
    {
        if($this->is_active == '0'){
            return ['id_cabang' => $this->id, 'next_status'=> 1];
        }else{
            return ['id_cabang' => $this->id, 'next_status'=> 0];
        }
    }

    public function url_form_edit($role)
    {
        if($role == 'AdminPusat'){
            return route('admin.pusat.form.edit.cabang', ['id' => $this->id]);
        }else{
            return route('admin.cabang.form.edit.cabang', ['id' => $this->id]);
        }
    }

    // public function getUrlAttribute() { 
    //     return route('post',[$this->attributes['slug']]); 
    //   } 
}
