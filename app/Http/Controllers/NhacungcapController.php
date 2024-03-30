<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Nhacungcap;

class NhacungcapController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET
        
        $ncc = Nhacungcap::all();
        return view("giaodien.app", [
            'page' => "nhacungcap.DSncc",
            "ncc"=> $ncc
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET
        return view("giaodien.app", [
            'page' => "nhacungcap.ViewAddNcc"
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        try {
            
            Nhacungcap::create([
                'TENNCC' => $request->TENNCC,
                'SDT' => $request->SDT,
                'DC' => $request->DC,
            ]);

            return back()->with('alert', 'Tạo thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }



    public function edit($id){   // Giao diện cập nhật dữ liệu: GET
        $ncc = Nhacungcap::find($id);

        return view("giaodien.app", [
            'page' => "nhacungcap.ViewUpdataNcc",
            "ncc"=> $ncc
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        try {

            Nhacungcap::where('MANCC', $request->MANCC)
            ->update([
                'TENNCC' => $request->TENNCC,
                'SDT' => $request->SDT,
                'DC' => $request->DC,
            ]);

            return back()->with('alert', 'Cập nhật thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function destroy($id){   // Xóa bỏ một dữ liệu: GET
        
        $ncc = Nhacungcap::find($id);
        $ncc->delete();
        return back()->with('success','Dữ liệu xóa thành công.');
    }
}
