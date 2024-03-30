<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Kho;

class KhoController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET
        $kho = Kho::all();

        return view("giaodien.app", [
            'page' => "kho.DSKho",
            "kho"=> $kho
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET
        return view("giaodien.app", [
            'page' => "kho.ViewAddKho"
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        try {
            
            Kho::create([
                'TENKHO' => $request->TENKHO,
                'SDT' => $request->SDT,
                'DC' => $request->DC,
            ]);

            return back()->with('alert', 'Tạo thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }



    public function edit($id){   // Giao diện cập nhật dữ liệu: GET
        $kho = Kho::find($id);

        return view("giaodien.app", [
            'page' => "kho.ViewUpdataKho",
            "kho"=> $kho
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        try {

            Kho::where('MAKHO', $request->MAKHO)
            ->update([
                'TENKHO' => $request->TENKHO,
                'SDT' => $request->SDT,
                'DC' => $request->DC,
            ]);

            return back()->with('alert', 'Cập nhật thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function destroy($id){   // Xóa bỏ một dữ liệu: GET
        $kho = Kho::find($id);

        $kho->delete();
        return back()->with('success','Dữ liệu xóa thành công.');
    }
}
