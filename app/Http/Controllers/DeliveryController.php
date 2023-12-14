<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CityModel;
use App\Models\WardsModel;
use App\Models\FeeshipModel;
use App\Models\ProvinceModel;
use Illuminate\Support\Facades\Auth;
session_start();

class DeliveryController extends Controller {

    public function AuthLogin() { //Kiểm tra đăng nhập Admin

        $admin_id = Auth::id();
        if($admin_id) {
            return redirect('admin');
        } else {
            return redirect('admin/dang-nhap')->send();
        }
    }

    public function update_delivery(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin
        
        $data = $request->all();
        $fee_ship = FeeshipModel::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], '.');
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
    }

    public function select_feeship() {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $feeship = FeeshipModel::orderby('fee_id','DESC')->get();
        $output = '';
        foreach ($feeship as $key => $fee) {
            $output.= '<tr>
                            <td>'.$fee->city_model->name_city.'</td>
                            <td>'.$fee->province_model->name_quanhuyen.'</td>
                            <td>'.$fee->wards_model->name_xaphuong.'</td>
                            <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship, 0, ',', '.').'</td>
                        </tr>
            ';
        }
        echo $output;
    }

    public function delivery(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $city = CityModel::orderby('matp', 'asc')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
    	if($data['action']) {
    		$output = '';
    		if ($data['action']=="city") {
    			$select_province = ProvinceModel::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>--- Chọn Quận / Huyện ---</option>';
    			foreach ($select_province as $key => $province) {
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}
    		} else {
    			$select_wards = WardsModel::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>--- Chọn Xã / Phường ---</option>';
    			foreach ($select_wards as $key => $ward) {
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    }

    public function add_delivery(Request $request) {

        $this->AuthLogin(); //Gọi hàm kiểm tra đăng nhập Admin

        $data = $request->all();
		$fee_ship = new FeeshipModel();
		$fee_ship->fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();
    }
}
