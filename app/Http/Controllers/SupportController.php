<?php

namespace App\Http\Controllers;
class SupportController extends Controller
{
    public function transport()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Thông tin";

        return view('pages.support.transport')->with('meta_title', $meta_title);
    }

    public function payment_guide()
    {
        $meta_title = "Cửa hàng bán quần áo thời trang Heaven | Thông tin";

        return view('pages.support.payment_guide')->with('meta_title', $meta_title);
    }
}
