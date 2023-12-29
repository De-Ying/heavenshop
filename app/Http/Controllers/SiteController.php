<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Coupon;

class SiteController extends Controller
{

    public function about() {
        $meta_title = "Thông tin";
        return view('pages.about')->with('meta_title', $meta_title);
    }

    public function contact()
    {
        $meta_title = "Liên hệ";
        $contacts = Contact::where('contact_status', 1)->get();

        return view('pages.contact', [
            'meta_title' => $meta_title,
            'contacts'    => $contacts
        ]);
    }

    public function coupon(Request $request) {
        $meta_title = "Mã Khuyến mãi";
        $today = date('Y-m-d');

        $query = Coupon::query();
        if ($status = $request->input('status')) {
            switch ($status) {
                case 'due':
                    $query->where('coupon_end_date', '>=', $today);
                    break;
                case 'expired':
                    $query->where('coupon_end_date', '<=', $today);
                    break;
                case 'used':
                    $customer_id = session('customer_id');
                    $query->where('coupon_used', 'LIKE', "%$customer_id%");
                    break;
            }
        }

        $coupons = $query->paginate(10);

        return view('pages.coupon', [
            'meta_title'   => $meta_title,
            'coupons'      => $coupons,
            'today'        => $today
        ]);
    }
}
