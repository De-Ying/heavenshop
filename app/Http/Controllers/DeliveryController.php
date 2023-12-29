<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Commune;
use App\Models\Feeship;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class DeliveryController extends Controller
{
    // GET: Hiển thị view vận chuyển
    public function delivery()
    {
        $cities = City::orderBy('city_id', 'ASC')->get();

        return view('admin.delivery.add_delivery', [
            'cities' => $cities
        ]);
    }

    // POST: Xử lý dữ liệu Ajax -> chọn xã, phường, huyện
    public function select_delivery(Request $request){
        $data = $request->all();
        if ($data['action']){
            $output = '';
            if ($data['action'] == "city"){
                $select_district = District::where('city_id', $data['ma_id'])->orderBy('district_id', 'ASC')->get();
                $output .= '<option>--- Chọn quận/huyện ---</option>';
                foreach ($select_district as $district) {
                    $output .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
                }

            }else{
                $select_commune = Commune::where('district_id', $data['ma_id'])->orderBy('commune_id', 'ASC')->get();
                $output .= '<option>--- Chọn xã/phường ---</option>';
                foreach ($select_commune as $commune) {
                    $output .= '<option value="' . $commune->commune_id . '">' . $commune->commune_name . '</option>';
                }
            }
        }
        echo $output;
    }

    /**
     * POST: Thêm vận chuyển
     *
     * @param  mixed $request
     * @return void
    */

    public function insert_delivery(Request $request){
        $data = $request->all();

        $delivery = Feeship::where([
            ['city_id', 'LIKE', '%'.$data['city_id'].'%'],
            ['district_id', 'LIKE', '%'.$data['district_id'].'%'],
            ['commune_id', 'LIKE', '%'.$data['commune_id'].'%'],
        ])->first();

        if($delivery){
            $feeship = new Feeship();
            $feeship->city_id     = $data['city_id'];
            $feeship->district_id = $data['district_id'];
            $feeship->commune_id  = $data['commune_id'];
            $feeship->save();
        }else{
            Feeship::create($data);
        }
    }

    /**
     * POST: Hiển thị dữ liệu phí vận chuyển
     *
     * @return void
    */
    public function select_feeship(){
        $feeship = Feeship::orderBy('fee_id', 'DESC')->get();
        $feeship_count = $feeship->count();
        $output = '';
        if($feeship_count > 0) {
            $output .= '<div class="row">
                            <div class="col s12">
                                <table id="page-length-option" class="display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên thành phố</th>
                                            <th>Tên quận/huyện</th>
                                            <th>Tên xã phường</th>
                                            <th>Phí ship</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ';
                                    $stt = 1;
                                    foreach ($feeship as $key => $fee) {
                                        $output .= '
                                        <tr>
                                            <td>' . $stt++ . '</td>
                                            <td>' . $fee->city->city_name . '</td>
                                            <td>' . $fee->district->district_name . '</td>
                                            <td>' . $fee->commune->commune_name . '</td>
                                            <td contenteditable data-feeship_id="' . $fee->fee_id . '" class="fee_feeship_edit">' . number_format($fee->fee_feeship, 0, ',', '.') . '</td>
                                        </tr>
                                        ';
                                    }
                                    $output .= '
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên thành phố</th>
                                            <th>Tên quận/huyện</th>
                                            <th>Tên xã phường</th>
                                            <th>Phí ship</th>
                                        </tr>
                                    </tfoot>
                                </table>
                             </div>
                        </div>
                     </div>

        ';

        // $output .= '
        //     <div>
        //         '. $feeship->links() .'
        //     </div>
        // ';

        }else{
            $output = 'Hiện tại không có dữ liệu';
        }
        echo $output;
    }

    /**
     * POST: Cập nhật giá tiền ship
     *
     * @param  mixed $request
     * @return void
    */

    public function update_feeship(Request $request){
        try {
            DB::beginTransaction();
            $data = $request->all();
            $fee_ship = Feeship::find($data['feeship_id']);
            $fee_price = rtrim($data['feeship_price'], '.');
            $fee_ship->fee_feeship = $fee_price;
            $fee_ship->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
