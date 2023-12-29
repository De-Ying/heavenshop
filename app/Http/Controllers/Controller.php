<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\Posts;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Customer;

use Carbon\Carbon;

class Controller
{
    public function dashboard(Request $request)
    {
        // Tổng đơn hàng
        $totalOrder     = Order::count();

        // Tổng khách hàng
        $totalCustomer  = Customer::count();

        // Tổng tiền doanh thu
        $totalSales = Statistic::sum('sales');

        // Tổng tiền lợi nhuận
        $totalProfit = Statistic::sum('profit');

        // Phần trăm doanh số
        if($totalSales != NULL && $totalProfit != NULL) {
            $percent = round($totalSales / $totalProfit, 2);
        } else {
            $percent = 0;
        }

        // Tổng sản phẩm
        $totalProduct   = Product::select('id')->count();


        // Tổng đánh giá
        $totalRating    = Rating::select('rating_id')->count();

        // Thời gian lưu
        $timer          = Carbon::now('Asia/Ho_Chi_Minh')->format('h:i:s A');

        // Danh sách đơn hàng mới
        $orders         = Order::with('customer')
        ->where('order_status', 1)
        ->limit(10)
        ->get();

        // Top sản phẩm mua nhiều nhất
        $topPayProducts   = Product::where('product_sold', '>', 0)
        ->orderByDesc('product_sold')
        ->limit(10)
        ->get();

        // Thống kê trạng thái đơn hàng
        // Đang chờ xử lý
        $pending = Order::where('order_status', 1)->get()->count();
        // Đã xử lý / Đang giao hàng
        $processed = Order::where('order_status', 2)->get()->count();
        // Hủy bỏ
        $cancel = Order::where('order_status', 3)->get()->count();

        $viewData = [
            'totalOrder'               => $totalOrder,
            'totalCustomer'            => $totalCustomer,
            'percent'                  => $percent,
            'totalProfit'              => $totalProfit,
            'totalProduct'             => $totalProduct,
            'totalRating'              => $totalRating,
            'timer'                    => $timer,
            'pending'                  => $pending,
            'processed'                => $processed,
            'cancel'                   => $cancel,
            'orders'                   => $orders,
            'topPayProducts'           => $topPayProducts
        ];

        return view('admin.dashboard', $viewData);
    }

    public function dashboardMC()
    {
        return view('admin.dashboardMC');
    }

    public function dashboardPCM()
    {
        return view('admin.dashboardPCM');
    }

    public function dashboardPSM()
    {
        return view('admin.dashboardPSM');
    }

    public function dashboardIM()
    {
        return view('admin.dashboardIM');
    }

    public function dashboardCC()
    {
        return view('admin.dashboardCC');
    }

    public function revenue_data()
    {
        $statistics = Statistic::orderBy('order_date', 'ASC')
        ->get();

        $sumSales = $statistics->sum('sales');

        foreach ($statistics as $statistic) {
            $order_date = $statistic->order_date;
            $funds = $statistic->funds;
            $sales = $statistic->sales;
            $profit = $statistic->profit;

            $percent = ( $sales / $sumSales ) * 100;
            $percentfm = round($percent, 2);

            $chartData['revenue'][] = array(
                'period'    => $order_date,   // ~ stage: giai đoạn
                'funds'     => $funds,
                'sales'     => $sales,        // ~ doanh số
                'profit'    => $profit,       // ~ lợi nhuận
                'percent'   => $percentfm
            );
        }

        echo json_encode($chartData);
    }

    public function profit_data()
    {
        $earlyLastMonth    = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('Y-m-d');
        $endLastMonth      = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->format('Y-m-d');
        $statistics = Statistic::whereBetween('order_date', [$earlyLastMonth, $endLastMonth])
        ->get();

        $sumProfit = $statistics->sum('profit');
        $earlyLastMonthfm = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('M d');
        $endLastMonthfm   = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->format('M d');

        foreach ($statistics as $statistic) {
            $order_date = $statistic->order_date;
            $profit = $statistic->profit;

            $chartData['profit'][] = array(
                'period'    => $order_date,   // ~ stage: giai đoạn
                'profit'    => $profit,       // ~ lợi nhuận
                'sumProfit' => $sumProfit,
                'earlyLastMonthfm' => $earlyLastMonthfm,
                'endLastMonthfm' => $endLastMonthfm,
            );
        }

        echo json_encode($chartData);
    }

    public function order_status_data(Request $request)
    {
        $data = $request->all();

        $orders = Order::whereBetween('order_date', [$data['order_status_from'], $data['order_status_to']])
        ->get();

        $pending = Order::where('order_status', 1)->get()->count();
        $processed = Order::where('order_status', 2)->get()->count();
        $cancel = Order::where('order_status', 3)->get()->count();

        foreach ($orders as $order) {
            $order_status = $order->order_status;

            if ($order_status == 1 && $pending > 0) {
                $order_status_name = 'Đang chờ xử lý';
                $order_status = $pending;
            } else if ($order_status == 2 && $processed > 0) {
                $order_status_name = 'Đã xử lý / Đang giao hàng';
                $order_status = $processed;
            } else if ($order_status == 3 && $cancel > 0) {
                $order_status_name = 'Đã hủy';
                $order_status = $cancel;
            }

            $chartData['orderStatusFilter'][] = array(
                'order_status_name'  => $order_status_name,   // ~ stage: giai đoạn
                'order_status'       => $order_status,       // ~ lợi nhuận
            );
        }

        echo json_encode($chartData);
    }

    public function load_order_status_data()
    {
        $earlyLastMonth    = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('Y-m-d');
        $endLastMonth      = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->format('Y-m-d');
        $orders = Order::whereBetween('order_date', [$earlyLastMonth, $endLastMonth])
        ->get();

        $pending = Order::where('order_status', 1)->get()->count();
        $processed = Order::where('order_status', 2)->get()->count();
        $cancel = Order::where('order_status', 3)->get()->count();

        foreach ($orders as $order) {
            $order_status = $order->order_status;

            if ($order_status == 1 && $pending > 0) {
                $order_status_name = 'Đang chờ xử lý';
                $order_status = $pending;
            } else if ($order_status == 2 && $processed > 0) {
                $order_status_name = 'Đã xử lý / Đang giao hàng';
                $order_status = $processed;
            } else if ($order_status == 3 && $cancel > 0) {
                $order_status_name = 'Đã hủy';
                $order_status = $cancel;
            }

            $chartData['orderStatus'][] = array(
                'order_status_name'  => $order_status_name,   // ~ stage: giai đoạn
                'order_status'       => $order_status,       // ~ lợi nhuận
            );
        }

        echo json_encode($chartData);
    }

    public function filter_by_date(Request $request)
    {
        $from_date = $request->from_date;
        $to_date   = $request->to_date;

        $statistics = Statistic::whereBetween('order_date', [$from_date,$to_date])
        ->orderBy('order_date', 'ASC')
        ->get();

        $order = Order::whereBetween('order_date', [$from_date,$to_date])
        ->orderBy('order_date', 'ASC')
        ->get();

        foreach ($statistics as $statistic) {

            $percent = round($statistic->sales / $statistic->profit, 2);

            $chartData[] = array(
                'period'   => $statistic->order_date,   // ~ stage: giai đoạn
                'order'    => $statistic->total_order,  // ~ tổng đơn hàng
                'sales'    => $statistic->sales,        // ~ doanh số
                'profit'   => $statistic->profit,       // ~ lợi nhuận
                'quantity' => $statistic->quantity,     // ~ Số lượng bán ra
                'percent'  => $percent            // ~ Phần trăm
            );
        }

        echo $data = json_encode($chartData);
    }

    public function filter_by_select(Request $request)
    {
        $data = $request->all();

        $now               = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $startOfMonth      = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $earlyLastMonth    = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $endLastMonth      = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $subWeek           = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $subYear           = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        if($data['filter_value'] == 'lastweek'){
            $statistic = Statistic::whereBetween('order_date', [$subWeek, $now])
            ->orderBy('order_date', 'ASC')
            ->get();
        }elseif($data['filter_value'] == 'lastMonth'){
            $statistic = Statistic::whereBetween('order_date', [$endLastMonth, $earlyLastMonth])
            ->orderBy('order_date', 'ASC')
            ->get();
        }elseif($data['filter_value'] == 'thisMonth'){
            $statistic = Statistic::whereBetween('order_date', [$startOfMonth, $now])
            ->orderBy('order_date', 'ASC')
            ->get();
        }else{
            $statistic = Statistic::whereBetween('order_date', [$subYear, $now])
            ->orderBy('order_date', 'ASC')
            ->get();
        }

        foreach ($statistic as $val) {

            $percent = round($val->sales / $val->profit, 2);

            $chartData[] = array(
                'period'   => $val->order_date,   // ~ stage: giai đoạn
                'order'    => $val->total_order,  // ~ tổng đơn hàng
                'sales'    => $val->sales,        // ~ doanh số
                'profit'   => $val->profit,       // ~ lợi nhuận
                'quantity' => $val->quantity,     // ~ Số lượng bán ra
                'percent'  => $percent            // ~ Phần trăm
            );
        }

        echo $data = json_encode($chartData);
    }

    public function days_order(Request $request)
    {
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $statistic = Statistic::whereBetween('order_date', [$sub60days, $now])
        ->orderBy('order_date', 'ASC')
        ->get();

        foreach($statistic as $val){

            $percent = round($val->sales / $val->profit, 2);

            $chartData[] = array(
                'period'   => $val->order_date,   // ~ stage: giai đoạn
                'order'    => $val->total_order,  // ~ tổng đơn hàng
                'sales'    => $val->sales,        // ~ doanh số
                'profit'   => $val->profit,       // ~ lợi nhuận
                'quantity' => $val->quantity,     // ~ Số lượng bán ra
                'percent'  => $percent            // ~ Phần trăm
            );
        }

        echo $data = json_encode($chartData);
    }
}
