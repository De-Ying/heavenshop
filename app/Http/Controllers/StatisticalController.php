<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\SalesExport;
use Carbon\Carbon;
use App\Models\Statistic;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use PDF;

class StatisticalController extends Controller
{

    public function timer()
    {
        return view('admin.statistic.sales.timer');
    }

    public function customer()
    {
        return view('admin.statistic.sales.customer');
    }

    public function product()
    {
        return view('admin.statistic.sales.product');
    }

    public function inventory(Request $request)
    {
        $categories = Category::where('category_status', 1)->get();
        $subcategory = Category::where('category_parent',0)->orderBy('category_id','DESC')->get();
        $brands     = Brand::where('brand_status', 1)->get();
        $suppliers  = Supplier::where('supplier_status', 1)->get();

        if($request->ajax()){

            $category_id = $request->category_id;
            $brand_id    = $request->brand_id;
            $supplier_id = $request->supplier_id;

            if (!empty($category_id) && !empty($brand_id) && !empty($supplier_id)) {
                $products = Product::where([
                    ['category_id', $category_id],
                    ['brand_id', $brand_id],
                    ['supplier_id', $supplier_id],
                ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else if (!empty($category_id) && !empty($brand_id)) {
                $products = Product::where([
                    ['category_id', $category_id],
                    ['brand_id', $brand_id],
                ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else if (!empty($brand_id) && !empty($supplier_id)) {
                $products = Product::where([
                    ['brand_id', $brand_id],
                    ['supplier_id', $supplier_id],
                ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else if (!empty($category_id) && !empty($supplier_id)) {
                $products = Product::where([
                    ['category_id', $category_id],
                    ['supplier_id', $supplier_id],
                ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else if (!empty($category_id)) {
                $products = Product::where('category_id', $category_id)
                ->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else if (!empty($brand_id)) {
                $products = Product::where('brand_id', $brand_id)
                ->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else if (!empty($supplier_id)) {
                $products = Product::where('supplier_id', $supplier_id)
                ->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            } else {
                $products = Product::select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
                ->get();
            }

            return datatables()->of($products)->make(true);
        }

        return view('admin.statistic.inventory', [
            'categories'  => $categories,
            'subcategory' => $subcategory,
            'brands'      => $brands,
            'suppliers'   => $suppliers
        ]);
    }

    public function pdf_inventory(Request $request)
    {
        $category_id = $request->category_id;
        $brand_id    = $request->brand_id;
        $supplier_id = $request->supplier_id;

        if (!empty($category_id) && !empty($brand_id) && !empty($supplier_id)) {
            $products = Product::where([
                ['category_id', $category_id],
                ['brand_id', $brand_id],
                ['supplier_id', $supplier_id],
            ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else if (!empty($category_id) && !empty($brand_id)) {
            $products = Product::where([
                ['category_id', $category_id],
                ['brand_id', $brand_id],
            ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else if (!empty($brand_id) && !empty($supplier_id)) {
            $products = Product::where([
                ['brand_id', $brand_id],
                ['supplier_id', $supplier_id],
            ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else if (!empty($category_id) && !empty($supplier_id)) {
            $products = Product::where([
                ['category_id', $category_id],
                ['supplier_id', $supplier_id],
            ])->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else if (!empty($category_id)) {
            $products = Product::where('category_id', $category_id)
            ->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else if (!empty($brand_id)) {
            $products = Product::where('brand_id', $brand_id)
            ->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else if (!empty($supplier_id)) {
            $products = Product::where('supplier_id', $supplier_id)
            ->select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        } else {
            $products = Product::select('product_image', 'product_name', 'product_quantity', 'product_sold', 'product_price', 'product_cost_price', DB::raw('(product_sold - product_quantity) * product_price AS totalPrice, (product_sold - product_quantity) * product_cost_price AS totalCostPrice'))
            ->get();
        }

        $pdf  = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_inventory_to_html($products));
        return $pdf->stream();
    }

    public function convert_inventory_to_html($products)
    {
        $output = '';

        $output .= '
        <style>
            body {
                font-family: DejaVu Sans;
                font-size: 12px;
            }

            .table {
                display: table;
                border-collapse: collapse;
            }

            .table-bordered {
                border: 1px solid #e9ecef;
            }

            .table>thead>tr>th {
                border-bottom-color: #ccc;
            }

            tr {
                display: table-row;
            }

            td {
                border: 1px solid #e9ecef;
                border-collapse: collapse;
            }
        </style>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>SL tồn</th>
                    <th>SL đã bán</th>
                    <th>Giá mua vào</th>
                    <th>Giá bán ra</th>
                    <th>Giá trị</th>
                    <th>Tổng giá bán SP</th>
                </tr>
            </thead>
            <tbody>';
            $stt = 1;
            foreach($products as $product) {
                $output .= '
                    <tr>
                        <td>'.$stt++.'</td>
                        <td>'.$product->product_name.'</td>
                        <td>'.$product->product_quantity.'</td>
                        <td>'.$product->product_sold.'</td>
                        <td>'.number_format($product->product_price,0,',','.') .'</td>
                        <td>'.number_format($product->product_cost_price,0,',','.') . ' ' . '₫'.'</td>
                        <td>'.number_format($product->totalPrice,0,',','.') . ' ' . '₫'.'</td>
                        <td>'.number_format($product->totalCostPrice,0,',','.') . ' ' . '₫'.'</td>
                    </tr>
                ';
            }

            $output.='
            </tbody>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>SL tồn</th>
                    <th>SL đã bán</th>
                    <th>Giá mua vào</th>
                    <th>Giá bán ra</th>
                    <th>Giá trị</th>
                    <th>Tổng giá bán SP</th>
                </tr>
            </tfoot>
        </table>
        ';

        return $output;
    }

    public function bill(Request $request)
    {
        $customers = Customer::all();

        if($request->ajax()){

            $order_from  = $request->order_from;
            $order_to    = $request->order_to;
            $customer_id = $request->customer_id;

            if(!empty($order_from) && !empty($order_to) && !empty($customer_id))
            {
                $orders = Order::whereBetween('order_date', [$order_from, $order_to])
                ->where('orders.customer_id', $customer_id)
                ->select('order_details.order_code', 'customer_name', 'customers.customer_id', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
                ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
                ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
                ->join('products', 'products.product_id', '=', 'order_details.product_id')
                ->groupBy('order_code')
                ->groupBy('customer_name')
                ->groupBy('customers.customer_id')
                ->groupBy('product_coupon')
                ->groupBy('product_feeship')
                ->groupBy('order_date')
                ->groupBy('order_status')
                ->get();

            }elseif (!empty($order_from) && !empty($order_to)) {
                $orders = Order::whereBetween('order_date', [$order_from, $order_to])
                ->select('order_details.order_code', 'customer_name', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
                ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
                ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
                ->join('products', 'products.product_id', '=', 'order_details.product_id')
                ->groupBy('order_code')
                ->groupBy('customer_name')
                ->groupBy('product_coupon')
                ->groupBy('product_feeship')
                ->groupBy('order_date')
                ->groupBy('order_status')
                ->get();

            } else if (!empty($customer_id)) {
                $orders = Order::where('orders.customer_id', $customer_id)
                ->select('order_details.order_code', 'customer_name', 'customers.customer_id', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
                ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
                ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
                ->join('products', 'products.product_id', '=', 'order_details.product_id')
                ->groupBy('order_code')
                ->groupBy('customer_name')
                ->groupBy('customers.customer_id')
                ->groupBy('product_coupon')
                ->groupBy('product_feeship')
                ->groupBy('order_date')
                ->groupBy('order_status')
                ->get();

            } else {
                $orders = Order::select('order_details.order_code', 'customer_name', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
                ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
                ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
                ->join('products', 'products.product_id', '=', 'order_details.product_id')
                ->groupBy('order_code')
                ->groupBy('customer_name')
                ->groupBy('product_coupon')
                ->groupBy('product_feeship')
                ->groupBy('order_date')
                ->groupBy('order_status')
                ->get();
            }
            return datatables()->of($orders)
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.statistic.bill')->with('customers', $customers);
    }

    public function pdf_bill(Request $request)
    {
        $order_from  = $request->order_from;
        $order_to    = $request->order_to;
        $customer_id = $request->customer_id;

        if(!empty($order_from) && !empty($order_to) && !empty($customer_id))
        {
            $orders = Order::whereBetween('order_date', [$order_from, $order_to])
            ->where('orders.customer_id', $customer_id)
            ->select('order_details.order_code', 'customer_name', 'customers.customer_id', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('order_code')
            ->groupBy('customer_name')
            ->groupBy('customers.customer_id')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->groupBy('order_status')
            ->get();

        }elseif (!empty($order_from) && !empty($order_to)) {
            $orders = Order::whereBetween('order_date', [$order_from, $order_to])
            ->select('order_details.order_code', 'customer_name', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('order_code')
            ->groupBy('customer_name')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->groupBy('order_status')
            ->get();

        } else if (!empty($customer_id)) {
            $orders = Order::where('orders.customer_id', $customer_id)
            ->select('order_details.order_code', 'customer_name', 'customers.customer_id', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('order_code')
            ->groupBy('customer_name')
            ->groupBy('customers.customer_id')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->groupBy('order_status')
            ->get();

        } else {
            $orders = Order::select('order_details.order_code', 'customer_name', 'product_coupon', 'product_feeship', 'order_date', 'order_status', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('order_code')
            ->groupBy('customer_name')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->groupBy('order_status')
            ->get();
        }

        $pdf  = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_bill_to_html($orders));
        return $pdf->stream();
    }

    public function convert_bill_to_html($orders)
    {
        $output = '';

        $output .= '
        <style>
            body {
                font-family: DejaVu Sans;
                font-size: 12px;
            }

            .table {
                display: table;
                border-collapse: collapse;
            }

            .table-bordered {
                border: 1px solid #e9ecef;
            }

            .table>thead>tr>th {
                border-bottom-color: #ccc;
            }

            tr {
                display: table-row;
            }

            td {
                border: 1px solid #e9ecef;
                border-collapse: collapse;
            }
        </style>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Mã giảm giá</th>
                    <th>Phí ship</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>';
            $stt = 1;
            foreach($orders as $order) {
                $output .= '
                    <tr>
                        <td>'.$stt++.'</td>
                        <td>'.$order->order_code.'</td>
                        <td>'.$order->customer_name.'</td>
                        <td>'.number_format($order->sales,0,',','.') .'</td>
                        <td>'.$order->product_coupon.'</td>
                        <td>'.$order->product_feeship.'</td>
                        <td>'.$order->order_date.'</td>
                        ';
                        if ($order->order_status == 1) {
                            $output .= 'Đang chờ xử lý';
                        } else if ($order->order_status == 2) {
                            $output .= 'Đã xử lý / Đã thanh toán';
                        } else {
                            $output .= 'Đã hủy';
                        }
                        $output .= '
                    </tr>
                ';
            }

            $output.='
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Mã đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Mã giảm giá</th>
                    <th>Phí ship</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                </tr>
            </tfoot>
        </table>
        ';

        return $output;
    }

    public function filter_by_date_timer(Request $request)
    {
        $timer_type = $request->timer_type;
        $timer_from = $request->timer_from;
        $timer_to   = $request->timer_to;


        if($timer_type == 'daily_report'){
            $today = Carbon::now()->format('Y-m-d');

            $statistics = Statistic::where('order_date', $today)->orderBy('order_date', 'ASC')
            ->get();

            $orders = Order::where('order_date', $today)
            ->select('customer_name', 'product_coupon', 'product_feeship', 'order_date', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('customer_name')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->get();

            $sumSales = $statistics->sum('sales');
            $sumFunds = $statistics->sum('funds');
            $sumProfit = $statistics->sum('profit');

        }else {
            $statistics = Statistic::whereBetween('order_date', [$timer_from, $timer_to])
            ->orderBy('order_date', 'ASC')
            ->get();

            $orders = Order::whereBetween('order_date', [$timer_from, $timer_to])
            ->select('customer_name', 'product_coupon', 'product_feeship', 'order_date', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('customer_name')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->get();

            // Statistic
            $sumSales = $statistics->sum('sales');
            $sumFunds = $statistics->sum('funds');
            $sumProfit = $statistics->sum('profit');
        }

        // dd($statistics, $orders, $sumSales, $sumFunds, $sumProfit);

        foreach ($statistics as $statistic) {
            $order_date = $statistic->order_date;

            $chartData['timeStatistic'][] = array(
                'period'    => $order_date,   // ~ stage: giai đoạn
                'funds'     => $statistic->funds,
                'sales'     => $statistic->sales,        // ~ doanh số
                'profit'    => $statistic->profit,       // ~ lợi nhuận
                'sumFunds'  => $sumFunds,
                'sumSales'  => $sumSales,
                'sumProfit' => $sumProfit,
                'townSize'  => 12
            );
        }

        foreach ($orders as $order) {

            $customer_name    = $order->customer_name;
            $quantity         = $order->quantity;
            $sales            = $order->sales;
            $funds            = $order->funds;
            $product_feeship  = $order->product_feeship;
            $product_coupon   = $order->product_coupon;
            $order_date       = $order->order_date;

            if($product_coupon != 'no'){
                $coupon              = Coupon::where('coupon_code', $product_coupon)->first();
                $coupon_condition    = $coupon->coupon_condition;
                $coupon_number       = $coupon->coupon_number;

                if($coupon_condition == 1){
                    $sales_coupon           = ($sales * $coupon_number) / 100;
                    $sales_coupon_after     = $sales - $sales_coupon + $product_feeship;
                }elseif($coupon_condition == 2){
                    $sales_coupon_after     = $sales - $coupon_number + $product_feeship;
                }

                $profit_coupon_after = $sales_coupon_after - $funds;
            }else{
                $coupon_number = 0;
                $sales_coupon_after     = $sales - $coupon_number + $product_feeship;
                $profit_coupon_after = $sales_coupon_after - $funds;
            }

            $salesDt  = $sales_coupon_after;
            $profitDt = $profit_coupon_after;

            $percent = round($salesDt / $profitDt, 2);

            $chartData['timeOrder'][] = array(
                'customer_name'          => $customer_name,
                'quantity'               => $quantity,
                'fundDt'                 => $funds,
                'salesDt'                => $salesDt,
                'profitDt'               => $profitDt,
                'percentDt'              => $percent,
                'orderDate'              => $order_date
            );
        }

        echo json_encode($chartData);
    }

    public function pdf_timer(Request $request)
    {
        $timer_type = $request->timer_type;
        $timer_from = $request->timer_from;
        $timer_to   = $request->timer_to;

        if($timer_type == 'daily_report'){
            $today = Carbon::now()->format('Y-m-d');

            $statistics = Statistic::where('order_date', $today)->orderBy('order_date', 'ASC')
            ->get();

            $orders = Order::where('order_date', $today)
            ->select('customer_name', 'product_coupon', 'product_feeship', 'order_date', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('customer_name')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->get();

            $sumSales = $statistics->sum('sales');
            $sumFunds = $statistics->sum('funds');
            $sumProfit = $statistics->sum('profit');

        }else {
            $statistics = Statistic::whereBetween('order_date', [$timer_from, $timer_to])
            ->orderBy('order_date', 'ASC')
            ->get();

            $orders = Order::whereBetween('order_date', [$timer_from, $timer_to])
            ->select('customer_name', 'product_coupon', 'product_feeship', 'order_date', DB::raw('SUM(order_details.product_sales_quantity) AS quantity, SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('customer_name')
            ->groupBy('product_coupon')
            ->groupBy('product_feeship')
            ->groupBy('order_date')
            ->get();

            // Statistic
            $sumSales = $statistics->sum('sales');
            $sumFunds = $statistics->sum('funds');
            $sumProfit = $statistics->sum('profit');
        }

        $pdf  = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_sales_times_to_html($orders));
        return $pdf->stream();
    }

    public function convert_sales_times_to_html($orders)
    {
        $output = '';

        $output .= '
        <style>
            body {
                font-family: DejaVu Sans;
                font-size: 12px;
            }

            .table {
                display: table;
                border-collapse: collapse;
            }

            .table-bordered {
                border: 1px solid #e9ecef;
            }

            .table>thead>tr>th {
                border-bottom-color: #ccc;
            }

            tr {
                display: table-row;
            }

            td {
                border: 1px solid #e9ecef;
                border-collapse: collapse;
            }
        </style>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Số lượng bán</th>
                    <th>Vốn</th>
                    <th>Doanh thu</th>
                    <th>Lợi nhuận</th>
                    <th>% lợi nhuận</th>
                    <th>Ngày</th>
                </tr>
            </thead>
            <tbody>';
            $stt = 1;
            foreach($orders as $order) {

                $customer_name    = $order->customer_name;
                $quantity         = $order->quantity;
                $sales            = $order->sales;
                $funds            = $order->funds;
                $product_feeship  = $order->product_feeship;
                $product_coupon   = $order->product_coupon;
                $order_date       = $order->order_date;


                if($product_coupon != 'no'){
                    $coupon              = Coupon::where('coupon_code', $product_coupon)->first();
                    $coupon_condition    = $coupon->coupon_condition;
                    $coupon_number       = $coupon->coupon_number;

                    if($coupon_condition == 1){
                        $sales_coupon           = ($sales * $coupon_number) / 100;
                        $sales_coupon_after     = $sales - $sales_coupon + $product_feeship;
                    }elseif($coupon_condition == 2){
                        $sales_coupon_after     = $sales - $coupon_number + $product_feeship;
                    }

                    $profit_coupon_after = $sales_coupon_after - $funds;
                }else{
                    $coupon_number = 0;
                    $sales_coupon_after     = $sales - $coupon_number + $product_feeship;
                    $profit_coupon_after = $sales_coupon_after - $funds;
                }

                $salesDt  = $sales_coupon_after;
                $profitDt = $profit_coupon_after;

                $percent = round($salesDt / $profitDt, 2);

                $output .= '
                    <tr>
                        <td>'.$stt++.'</td>
                        <td>'.$customer_name.'</td>
                        <td>'.$quantity.'</td>
                        <td>'.number_format($funds,0,',','.') .'</td>
                        <td>'.number_format($salesDt,0,',','.') .'</td>
                        <td>'.number_format($profitDt,0,',','.') .'</td>
                        <td>'.$percent.'% </td>
                        <td>'.$order_date.'</td>
                    </tr>
                ';
            }

            $output.='
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Số lượng bán</th>
                    <th>Vốn</th>
                    <th>Doanh thu</th>
                    <th>Lợi nhuận</th>
                    <th>% lợi nhuận</th>
                    <th>Ngày</th>
                </tr>
            </tfoot>
        </table>
        ';

        return $output;
    }

    public function filter_by_date_customer(Request $request)
    {
        $customer_type = $request->customer_type;
        $customer_from = $request->customer_from;
        $customer_to   = $request->customer_to;

        // dd($customer_type, $customer_from, $customer_to);

        if($customer_type == 'daily_report'){
            $today = Carbon::today()->format('Y-m-d');

            $orders = Order::where('order_date', $today)
            ->select('customer_name', 'customer_image', 'order_date', DB::raw('SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('customer_name')
            ->groupBy('customer_image')
            ->groupBy('order_date')
            ->get();

            // dd($orders);

            $sumSales = $orders->sum('sales');
            $sumFunds = $orders->sum('funds');
            $sumProfit = $orders->sum('profit');
        }else{
            $orders = Order::whereBetween('order_date', [$customer_from, $customer_to])
            ->select('customer_name', 'customer_image', 'order_date', DB::raw('SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('customer_name')
            ->groupBy('customer_image')
            ->groupBy('order_date')
            ->get();

            $sumSales = $orders->sum('sales');
            $sumFunds = $orders->sum('funds');
            $sumProfit = $orders->sum('profit');
        }

        foreach ($orders as $order) {

            $url = asset('public/uploads/customer/'.$order->customer_image);

            $chart['customerStatistic'][] = array(
                'sumFunds'  => $sumFunds,
                'sumSales'  => $sumSales,
                'sumProfit' => $sumProfit,
                'name'      => $order->customer_name,
                'steps'     => $order->profit,
                'href'      => $url,
            );
        }

        echo json_encode($chart);
    }

    public function filter_by_date_product(Request $request)
    {
        $product_type = $request->product_type;
        $product_from = $request->product_from;
        $product_to   = $request->product_to;

        if($product_type == 'daily_report'){
            $today = Carbon::today()->format('Y-m-d');

            $orders = Order::where('order_date', $today)
            ->select('product_name', 'product_image', 'order_date', 'order_details.order_code', DB::raw('SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('product_name')
            ->groupBy('product_image')
            ->groupBy('order_date')
            ->groupBy('order_code')
            ->get();

            $sumSales = $orders->sum('sales');
            $sumFunds = $orders->sum('funds');
            $sumProfit = $orders->sum('profit');
        }else if ($product_type == 'monthly_report') {
            $orders = Order::whereBetween('order_date', [$product_from, $product_to])
            ->select('product_name', 'product_image', 'order_date', 'order_details.order_code', DB::raw('SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('product_name')
            ->groupBy('product_image')
            ->groupBy('order_date')
            ->groupBy('order_code')
            ->limit(10)
            ->get();

            $sumSales = $orders->sum('sales');
            $sumFunds = $orders->sum('funds');
            $sumProfit = $orders->sum('profit');
        } else {
            $orders = Order::select('product_name', 'product_image', 'order_date', 'order_details.order_code', DB::raw('SUM(order_details.product_price * order_details.product_sales_quantity) AS sales, SUM(products.product_cost_price * order_details.product_sales_quantity) AS funds, SUM(order_details.product_price * order_details.product_sales_quantity - products.product_cost_price * order_details.product_sales_quantity) AS profit'))
            ->join('order_details', 'order_details.order_code', '=', 'orders.order_code')
            ->join('products', 'products.product_id', '=', 'order_details.product_id')
            ->groupBy('product_name')
            ->groupBy('product_image')
            ->groupBy('order_date')
            ->groupBy('order_code')
            ->limit(10)
            ->get();

            $sumSales = $orders->sum('sales');
            $sumFunds = $orders->sum('funds');
            $sumProfit = $orders->sum('profit');
        }

        foreach ($orders as $order) {

            $url = asset('public/uploads/product/'.$order->product_image);

            $chart['productStatistic'][] = array(
                'sumFunds'  => $sumFunds,
                'sumSales'  => $sumSales,
                'sumProfit' => $sumProfit,
                'name'      => $order->product_name,
                'steps'     => $order->profit,
                'href'      => $url,
            );
        }

        echo json_encode($chart);
    }

    public function export_sale_excel(Request $request)
    {
        $timer_type = $request->timer_type;
        $timer_from = $request->timer_from;
        $timer_to   = $request->timer_to;

        return Excel::download(new SalesExport($timer_type, $timer_from, $timer_to), 'HV-sales-export.xlsx');
    }

}
