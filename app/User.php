<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','no_ktp', 'no_hp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'user_id');
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class, 'kantor_id');
    }

    public function str_change_staus()
    {
        if($this->is_active == '0'){
            return 'Aktifkan';
        }else{
            return 'Hapus';
        }
    }

    public function str_status()
    {
        if($this->is_active == '0'){
            return '<span class="badge badge-danger"> Tidak Aktif</span>';
        }else{
            return '<span class="badge badge-success"> Aktif</span>';
        }
    }

    public function url_form_edit_cs($role)
    {
        if($role == 'AdminPusat'){
            return route('admin.pusat.form.edit.cs', ['id' => $this->id]);
        }else if($role == 'AdminCabang'){
            return route('admin.cabang.form.edit.cs', ['id' => $this->id]);
        }else if($role == 'AdminCabangPembantu'){
            return route('admin.cabang_pembantu.form.edit.cs', ['id' => $this->id]);
        }
    }

    public function param_route_edit_status_cs()
    {
        if($this->is_active == '0'){
            return ['id_cabang' => $this->id, 'next_status'=> 1];
        }else{
            return ['id_cabang' => $this->id, 'next_status'=> 0];
        }
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'cs_id');
    }

    public function service_duration()
    {
        $duration_data = Transaksi::selectRaw(" SEC_TO_TIME(SUM(TIME_TO_SEC(transaksi.jam_selesai) - TIME_TO_SEC( transaksi.jam_mulai ))) AS timediff ")->where('cs_id', $this->id)->first();
        if(!$duration_data->timediff){
            return '-';
        }
        $duration = $this->time_to_decimal($duration_data->timediff);
        return $duration/count($this->transaksi) . '/ Pelayanan';
    }

    function time_to_decimal($time) {
        $timeArr = explode(':', $time);
        $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
     
        return $decTime;
    }
}
