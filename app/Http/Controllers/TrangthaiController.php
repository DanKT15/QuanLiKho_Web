<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Trangthai;

class TrangthaiController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET

        $trangthai = Trangthai::all();

        return view("giaodien.app", [
            'page' => "trangthai.DStrangthai",
            "trangthai"=> $trangthai
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET
        return view("giaodien.app", [
            'page' => "trangthai.ViewAddTrangthai"
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        $rules = [
            'TENTT' => 'required',
        ];

        $mess = [
            'TENTT.required' => 'Chưa nhập thông tin',
        ];

        $request->validate($rules, $mess);

        try {
            
            Trangthai::create([
                'TENTT' => $request->TENTT,
            ]);

            return back()->with('alert', 'Tạo trạng thái thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function edit($id){   // Giao diện cập nhật dữ liệu: GET

        $trangthai = Trangthai::find($id);

        return view("giaodien.app", [
            'page' => "trangthai.ViewUpdataTrangthai",
            "trangthai"=> $trangthai
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        $rules = [
            'MATT' => 'required|numeric',
            'TENTT' => 'required'
        ];

        $mess = [
            'MATT.required' => 'Chưa có id thông tin',
            'TENTT.required' => 'Chưa nhập thông tin',
        ];

        $request->validate($rules, $mess);

        try {

            Trangthai::where('MATT', $request->MATT)
            ->update([
                'TENTT' => $request->TENTT,
            ]);

            return back()->with('alert', 'Cập nhật trạng thái thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function destroy(Request $request){   // Xóa bỏ một dữ liệu: GET
        $rules = [
            'MATT' => 'required|numeric',
        ];

        $mess = [
            'MATT.required' => 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        $trangthai = Trangthai::find($request->MATT);

        if($trangthai){
            $trangthai->delete();
            return back()->with('alert', 'Xóa thành công');
        }

        return back()->with('err', 'Không tồn tại dữ liệu cần xóa');
    }
}
