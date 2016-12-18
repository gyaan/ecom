<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {

    }


    public function index(){
//         echo App::environment('LATEST_FEATURED_PRODUCTS');

        echo env('LATEST_PRODUCT_COUNT');
    }
    //
}
