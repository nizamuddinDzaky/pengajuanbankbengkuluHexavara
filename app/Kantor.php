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

    // public function getUrlAttribute() { 
    //     return route('post',[$this->attributes['slug']]); 
    //   } 
}
