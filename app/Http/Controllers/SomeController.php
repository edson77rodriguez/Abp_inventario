<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SomeController extends Controller
{
    public function showCheckout()
    {
        return view('checkout');
    }
}
