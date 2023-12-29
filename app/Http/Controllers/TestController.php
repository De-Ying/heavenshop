<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Coupon;

class TestController extends Controller
{
    public function index()
    {
        $data = Coupon::paginate(2);
        return view('test',compact('data'));
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = Coupon::paginate(5);
            return view('test2', compact('data'))->render();
        }
    }
}
