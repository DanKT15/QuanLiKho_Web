<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\DCnhapxuat;

class DCnhapxuatController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET

        $diachi = DCnhapxuat::all();

        return view("giaodien.app", [
            'page' => "DCnhapxuat.DSdiachi",
            "diachi"=> $diachi
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET
        return view("giaodien.app", [
            'page' => "DCnhapxuat.ViewAddDiachi"
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        $rules = [
            'TENDC' => 'required',
            'DCNHAPXUAT' => 'required'
        ];

        $mess = [
            'TENDC.required' => 'Chưa nhập thông tin',
            'DCNHAPXUAT.required' => 'Chưa nhập thông tin',
        ];

        $request->validate($rules, $mess);

        try {
            
            DCnhapxuat::create([
                'TENDC' => $request->TENDC,
                'DCNHAPXUAT' => $request->DCNHAPXUAT
            ]);

            return back()->with('alert', 'Tạo địa chỉ thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function edit($id){   // Giao diện cập nhật dữ liệu: GET

        $diachi = DCnhapxuat::find($id);

        return view("giaodien.app", [
            'page' => "DCnhapxuat.ViewUpdataDiachi",
            "diachi"=> $diachi
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        $rules = [
            'MADC' => 'required|numeric',
            'TENDC' => 'required',
            'DCNHAPXUAT' => 'required'
        ];

        $mess = [
            'MADC.required' => 'Chưa có id thông tin',
            'TENDC.required' => 'Chưa nhập thông tin',
            'DCNHAPXUAT.required' => 'Chưa nhập thông tin',
        ];

        $request->validate($rules, $mess);

        try {

            DCnhapxuat::where('MADC', $request->MADC)
            ->update([
                'TENDC' => $request->TENDC,
                'DCNHAPXUAT' => $request->DCNHAPXUAT
            ]);

            return back()->with('alert', 'Cập nhật địa chỉ thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function destroy(Request $request){   // Xóa bỏ một dữ liệu: GET
        $rules = [
            'MADC' => 'required|numeric'
        ];

        $mess = [
            'MADC.required' => 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        $diachi = DCnhapxuat::find($request->MADC);

        if($diachi){
            $diachi->delete();
            return back()->with('alert', 'Xóa thành công');
        }

        return back()->with('err', 'Không tồn tại dữ liệu cần xóa');
    }
}
