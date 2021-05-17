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

}
