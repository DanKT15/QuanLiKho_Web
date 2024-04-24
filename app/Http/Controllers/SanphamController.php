<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Sanpham;
use App\Models\Loaisp;
use App\Models\Nhacungcap;
use App\Models\Nhansu;

class SanphamController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET

        $sanpham = Sanpham::all();
        $Loaisp = Loaisp::all();
        $Nhacungcap = Nhacungcap::all();

        return view("giaodien.app", [
            'page' => "sanpham.DSsanpham",
            "sanpham"=> $sanpham,
            "Loaisp"=> $Loaisp,
            "Nhacungcap"=> $Nhacungcap
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET

        $sanpham = Sanpham::all();
        $Loaisp = Loaisp::all();
        $Nhacungcap = Nhacungcap::all();

        return view("giaodien.app", [
            'page' => "sanpham.ViewAddSanpham",
            "sanpham"=> $sanpham,
            "Loaisp"=> $Loaisp,
            "Nhacungcap"=> $Nhacungcap
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        $rules = [
            'TENSP' => 'required|regex:/[[:alpha:]]\s/',
            'MALOAI' => 'required|numeric',
            'MANCC' => 'required|numeric',
            'THONGTIN' => 'required|regex:/[[:alpha:]]\s/',
            'GIASP' => 'required|numeric'
        ];

        $mess = [
            'TENSP.required' => 'Chưa nhập thông tin',
            'TENSP.regex' => 'Vui lòng nhập ký tự chữ cái',

            'MALOAI.required' => 'Chưa chọn thông tin',
            'MALOAI.numeric' => 'Vui lòng nhập chữ số',

            'MANCC.required' => 'Chưa chọn thông tin',
            'MANCC.numeric' => 'Vui lòng nhập chữ số',

            'THONGTIN.required' => 'Chưa nhập thông tin',
            'THONGTIN.regex' => 'Vui lòng nhập ký tự chữ cái',

            'GIASP.required' => 'Vui lòng nhập giá',
            'GIASP.numeric' => 'Vui lòng nhập chữ số'
        ];

        $request->validate($rules, $mess);

        try {
            
            $idsp = Sanpham::insertGetId([
                'TENSP' => $request->TENSP,
                'MALOAI' => $request->MALOAI,
                'MANCC' => $request->MANCC,
                'THONGTIN' => $request->THONGTIN,
                'GIASP' => $request->GIASP
            ]);

            Sanpham::where('MASP', $idsp)->update(['qrcode' => $idsp]);

            return back()->with('alert', 'Tạo sản phẩm thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function edit($id){   // Giao diện cập nhật dữ liệu: GET

        $sanpham = Sanpham::find($id);
        $Loaisp = Loaisp::all();
        $Nhacungcap = Nhacungcap::all();

        return view("giaodien.app", [
            'page' => "sanpham.ViewUpdataSanpham",
            "sanpham"=> $sanpham,
            "Loaisp"=> $Loaisp,
            "Nhacungcap"=> $Nhacungcap
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        $rules = [
            'MASP' => 'required|numeric',
            'TENSP' => 'required|regex:/[[:alpha:]]\s/',
            'MALOAI' => 'required|numeric',
            'MANCC' => 'required|numeric',
            'THONGTIN' => 'required|regex:/[[:alpha:]]\s/',
            'GIASP' => 'required|numeric'
        ];

        $mess = [
            'MASP.required' => 'Chưa có id thông tin',

            'TENSP.required' => 'Chưa nhập thông tin',
            'TENSP.regex' => 'Vui lòng nhập ký tự chữ cái',

            'MALOAI.required' => 'Chưa chọn thông tin',
            'MALOAI.numeric' => 'Vui lòng nhập chữ số',

            'MANCC.required' => 'Chưa chọn thông tin',
            'MANCC.numeric' => 'Vui lòng nhập chữ số',

            'THONGTIN.required' => 'Chưa nhập thông tin',
            'THONGTIN.regex' => 'Vui lòng nhập ký tự chữ cái',

            'GIASP.required' => 'Vui lòng nhập giá',
            'GIASP.numeric' => 'Vui lòng nhập chữ số'
        ];

        $request->validate($rules, $mess);

        try {

            Sanpham::where('MASP', $request->MASP)
            ->update([
                'TENSP' => $request->TENSP,
                'MALOAI' => $request->MALOAI,
                'MANCC' => $request->MANCC,
                'THONGTIN' => $request->THONGTIN,
                'GIASP' => $request->GIASP
            ]);

            return back()->with('alert', 'Cập nhật sản phẩm thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
    }

    public function destroy(Request $request){   // Xóa bỏ một dữ liệu: GET
        $rules = [
            'MASP' => 'required|numeric'
        ];

        $mess = [
            'MASP.required' => 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        $sanpham = Sanpham::find($request->MASP);

        if($sanpham){
            $sanpham->delete();
            return back()->with('alert', 'Xóa thành công');
        }

        return back()->with('err', 'Không tồn tại dữ liệu cần xóa');
    }

    public function thongke(){  
        
        // SELECT s.MASP, s.TENSP, tk.SLNHAP, tk.SLXUAT, tk.SLTONKHO
        // FROM sanpham s
        // INNER JOIN tonkho tk ON tk.MASP = s.MASP
        // INNER JOIN kho k ON k.MAKHO = tk.MAKHO 
        // WHERE k.MAKHO = 1111

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        $thongke = DB::table('sanpham')
        ->join('tonkho','tonkho.MASP','=','sanpham.MASP')
        ->join('kho','kho.MAKHO','=','tonkho.MAKHO')
        ->where('kho.MAKHO', $makho)
        ->select('sanpham.MASP','sanpham.TENSP','tonkho.SLNHAP','tonkho.SLXUAT','tonkho.SLTONKHO')
        ->get();

        return view("giaodien.app", [
            'page' => "sanpham.thongke",
            'thongke' => $thongke
        ]);

    }

    public function thongkeDate(Request $request){   

        $rules = [
            'date1' => 'required|date',
            'date2' => 'required|date'
        ];

        $mess = [
            'date1.required' => 'Chưa có id thông tin',
            'date2.required' => 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        if (strtotime($request->date1) > strtotime($request->date2)) {
            return back()->with('err', 'Ngày tháng không hợp lệ');
        }

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;


        $soluongthangtruoc = DB::select(
            '
                SELECT sanpham.MASP, sanpham.TENSP, SUM(ct_nhapxuat.SOLUONG) as SOLUONG, trangthai.TENTT
                FROM sanpham, ct_nhapxuat, phieunhapxuat, trangthai, users, nhansu, kho
                WHERE kho.MAKHO = ?
                AND DATE(phieunhapxuat.NGAYLAP) <= ?
                AND sanpham.MASP = ct_nhapxuat.MASP
                AND ct_nhapxuat.MAPHIEU = phieunhapxuat.id
                AND phieunhapxuat.MATT = trangthai.MATT
                AND phieunhapxuat.MANV = users.MANV
                AND users.MANV = nhansu.MANV
                AND nhansu.MAKHO = kho.MAKHO
                GROUP BY sanpham.MASP, trangthai.MATT
            ',
            [$makho, $request->date1]
        );

        $thongke = DB::select(
            '
                SELECT sanpham.MASP, sanpham.TENSP, SUM(ct_nhapxuat.SOLUONG) as SOLUONG, trangthai.TENTT
                FROM sanpham, ct_nhapxuat, phieunhapxuat, trangthai, users, nhansu, kho
                WHERE kho.MAKHO = ?
                AND DATE(phieunhapxuat.NGAYLAP) >= ? AND DATE(phieunhapxuat.NGAYLAP) <= ?
                AND sanpham.MASP = ct_nhapxuat.MASP
                AND ct_nhapxuat.MAPHIEU = phieunhapxuat.id
                AND phieunhapxuat.MATT = trangthai.MATT
                AND phieunhapxuat.MANV = users.MANV
                AND users.MANV = nhansu.MANV
                AND nhansu.MAKHO = kho.MAKHO
                GROUP BY sanpham.MASP, trangthai.MATT
            ', 
            [$makho, $request->date1, $request->date2]
        );

        if (!empty($soluongthangtruoc)) {
            
            $tonkhothangtruoc = [];

            for ($i = 0; $i < count($soluongthangtruoc); $i += 2) { 
                $tonkho = $soluongthangtruoc[$i]->SOLUONG - $soluongthangtruoc[$i + 1]->SOLUONG;
                array_push($tonkhothangtruoc, (object) array(
                    'MASP' => $soluongthangtruoc[$i]->MASP,
                    'TENSP' => $soluongthangtruoc[$i]->TENSP,
                    'TONKHO' => $tonkho
                ));
            }

            $tonkhothangnay = [];

            for ($i = 0; $i < count($thongke); $i += 2) { 

                for ($j = 0; $j < count($tonkhothangtruoc); $j++) { 
                    if ($thongke[$i]->MASP ==  $tonkhothangtruoc[$j]->MASP) {
                        $tonkho =  ($tonkhothangtruoc[$j]->TONKHO + $thongke[$i]->SOLUONG) - $thongke[$i + 1]->SOLUONG;
                        array_push($tonkhothangnay, (object) array(
                            'MASP' => $thongke[$i]->MASP,
                            'TENSP' => $thongke[$i]->TENSP,
                            'SLNHAP' => $tonkhothangtruoc[$j]->TONKHO + $thongke[$i]->SOLUONG,
                            'SLXUAT' => $thongke[$i + 1]->SOLUONG,
                            'SLTONKHO' => $tonkho,
                            'date1' => $request->date1,
                            'date2' => $request->date2
                        ));
                        break;
                    }
                }

            }

        }
        else {

            $tonkhothangnay = [];

            for ($i = 0; $i < count($thongke); $i += 2) { 
                $tonkho = $thongke[$i]->SOLUONG - $thongke[$i + 1]->SOLUONG;
                array_push($tonkhothangnay, (object) array(
                    'MASP' => $thongke[$i]->MASP,
                    'TENSP' => $thongke[$i]->TENSP,
                    'SLNHAP' => $thongke[$i]->SOLUONG,
                    'SLXUAT' => $thongke[$i + 1]->SOLUONG,
                    'SLTONKHO' => $tonkho,
                    'date1' => $request->date1,
                    'date2' => $request->date2
                ));
            }

        }

        return view("giaodien.app", [
            'page' => "sanpham.thongke",
            'thongke' => $tonkhothangnay
        ]);

    }

    public function exportPDF(Request $request){   // Lấy chi tiết của một dữ liệu: GET

        $rules = [
            'logic' => 'required|integer',
            'date1' => 'date',
            'date2' => 'date'
        ];

        $mess = [
            'logic.required' => 'Chưa thỏa điều kiện sử dụng chức năng'
        ];

        $request->validate($rules, $mess);

        if (strtotime($request->date1) > strtotime($request->date2)) {
            return back()->with('err', 'Ngày tháng không hợp lệ');
        }

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        if ($request->logic == 0) {
            
            $tonkhothangnay = DB::table('sanpham')
            ->join('tonkho','tonkho.MASP','=','sanpham.MASP')
            ->join('kho','kho.MAKHO','=','tonkho.MAKHO')
            ->where('kho.MAKHO', $makho)
            ->select('sanpham.MASP','sanpham.TENSP','tonkho.SLNHAP','tonkho.SLXUAT','tonkho.SLTONKHO')
            ->get();

        } else {
            
            $soluongthangtruoc = DB::select(
                '
                    SELECT sanpham.MASP, sanpham.TENSP, SUM(ct_nhapxuat.SOLUONG) as SOLUONG, trangthai.TENTT
                    FROM sanpham, ct_nhapxuat, phieunhapxuat, trangthai, users, nhansu, kho
                    WHERE kho.MAKHO = ?
                    AND DATE(phieunhapxuat.NGAYLAP) <= ?
                    AND sanpham.MASP = ct_nhapxuat.MASP
                    AND ct_nhapxuat.MAPHIEU = phieunhapxuat.id
                    AND phieunhapxuat.MATT = trangthai.MATT
                    AND phieunhapxuat.MANV = users.MANV
                    AND users.MANV = nhansu.MANV
                    AND nhansu.MAKHO = kho.MAKHO
                    GROUP BY sanpham.MASP, trangthai.MATT
                ',
                [$makho, $request->date1]
            );
    
            $thongke = DB::select(
                '
                    SELECT sanpham.MASP, sanpham.TENSP, SUM(ct_nhapxuat.SOLUONG) as SOLUONG, trangthai.TENTT
                    FROM sanpham, ct_nhapxuat, phieunhapxuat, trangthai, users, nhansu, kho
                    WHERE kho.MAKHO = ?
                    AND DATE(phieunhapxuat.NGAYLAP) >= ? AND DATE(phieunhapxuat.NGAYLAP) <= ?
                    AND sanpham.MASP = ct_nhapxuat.MASP
                    AND ct_nhapxuat.MAPHIEU = phieunhapxuat.id
                    AND phieunhapxuat.MATT = trangthai.MATT
                    AND phieunhapxuat.MANV = users.MANV
                    AND users.MANV = nhansu.MANV
                    AND nhansu.MAKHO = kho.MAKHO
                    GROUP BY sanpham.MASP, trangthai.MATT
                ', 
                [$makho, $request->date1, $request->date2]
            );
    
            if (!empty($soluongthangtruoc)) {
                
                $tonkhothangtruoc = [];
    
                for ($i = 0; $i < count($soluongthangtruoc); $i += 2) { 
                    $tonkho = $soluongthangtruoc[$i]->SOLUONG - $soluongthangtruoc[$i + 1]->SOLUONG;
                    array_push($tonkhothangtruoc, (object) array(
                        'MASP' => $soluongthangtruoc[$i]->MASP,
                        'TENSP' => $soluongthangtruoc[$i]->TENSP,
                        'TONKHO' => $tonkho
                    ));
                }
    
                $tonkhothangnay = [];
    
                for ($i = 0; $i < count($thongke); $i += 2) { 
    
                    for ($j = 0; $j < count($tonkhothangtruoc); $j++) { 
                        if ($thongke[$i]->MASP ==  $tonkhothangtruoc[$j]->MASP) {
                            $tonkho =  ($tonkhothangtruoc[$j]->TONKHO + $thongke[$i]->SOLUONG) - $thongke[$i + 1]->SOLUONG;
                            array_push($tonkhothangnay, (object) array(
                                'MASP' => $thongke[$i]->MASP,
                                'TENSP' => $thongke[$i]->TENSP,
                                'SLNHAP' => $tonkhothangtruoc[$j]->TONKHO + $thongke[$i]->SOLUONG,
                                'SLXUAT' => $thongke[$i + 1]->SOLUONG,
                                'SLTONKHO' => $tonkho,
                                'date1' => $request->date1,
                                'date2' => $request->date2
                            ));
                            break;
                        }
                    }
    
                }
    
            }
            else {
    
                $tonkhothangnay = [];
    
                for ($i = 0; $i < count($thongke); $i += 2) { 
                    $tonkho = $thongke[$i]->SOLUONG - $thongke[$i + 1]->SOLUONG;
                    array_push($tonkhothangnay, (object) array(
                        'MASP' => $thongke[$i]->MASP,
                        'TENSP' => $thongke[$i]->TENSP,
                        'SLNHAP' => $thongke[$i]->SOLUONG,
                        'SLXUAT' => $thongke[$i + 1]->SOLUONG,
                        'SLTONKHO' => $tonkho,
                        'date1' => $request->date1,
                        'date2' => $request->date2
                    ));
                }
    
            }

        }
        
        
        $pdf = Pdf::loadView('giaodien.export.thongke', [
            'thongke' => $tonkhothangnay
        ]);

        return $pdf->stream();

    }

}
