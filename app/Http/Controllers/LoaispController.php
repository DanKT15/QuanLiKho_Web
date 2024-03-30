<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Loaisp;

class LoaispController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET
        $loai = Loaisp::all();

        return view("giaodien.app", [
            'page' => "loaisp.DSloaisp",
            "loai"=> $loai
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET
        return view("giaodien.app", [
            'page' => "loaisp.ViewAddLoaisp"
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        try {
            
            Loaisp::create([
                'TENLOAI' => $request->TENLOAI,
            ]);

            return back()->with('alert', 'Tạo thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }


    public function edit($id){   // Giao diện cập nhật dữ liệu: GET
        $loai = Loaisp::find($id);

        return view("giaodien.app", [
            'page' => "loaisp.ViewUpdataLoaisp",
            "loai"=> $loai
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        try {

            Loaisp::where('MALOAI', $request->MALOAI)
            ->update([
                'TENLOAI' => $request->TENLOAI,
            ]);

            return back()->with('alert', 'Cập nhật thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function destroy($id){   // Xóa bỏ một dữ liệu: GET
        $loai = Loaisp::find($id);

        $loai->delete();
        return back()->with('success','Dữ liệu xóa thành công.');
    }
}
