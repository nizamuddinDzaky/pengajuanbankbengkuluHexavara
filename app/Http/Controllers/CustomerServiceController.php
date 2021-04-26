<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function jadwal(){


        return view('customer_service.jadwal');
    }

    public function pelayanan_nasabah(){


        return view('customer_service.pelayanan_nasabah');
    }
}
