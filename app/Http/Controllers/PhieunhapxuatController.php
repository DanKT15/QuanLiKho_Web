<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\Phieunhapxuat;
use App\Models\Sanpham;
use App\Models\CTnhapxuat;
use App\Models\Nhansu;
use App\Models\User;
use App\Models\DCnhapxuat;
use App\Models\Trangthai;
use App\Models\Tonkho;
use App\Models\Kho;


class PhieunhapxuatController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET

        // SELECT *
        // FROM phieunhapxuat p
        // INNER JOIN users u ON u.MANV = p.MANV
        // INNER JOIN nhansu n ON n.MANV = u.MANV
        // INNER JOIN kho k ON k.MAKHO = n.MAKHO
        // WHERE k.MAKHO = 1111

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        $phieu = DB::table('phieunhapxuat')
        ->join('users','users.MANV','=','phieunhapxuat.MANV')
        ->join('nhansu','nhansu.MANV','=','users.MANV')
        ->join('kho','kho.MAKHO','=','nhansu.MAKHO')
        ->where('kho.MAKHO', $makho)
        ->select('phieunhapxuat.id','phieunhapxuat.SOPHIEU','phieunhapxuat.MANV','phieunhapxuat.MADC','phieunhapxuat.MATT', 'phieunhapxuat.NGAYLAP')
        ->get();
    
        $Trangthai = Trangthai::all();

        return view("giaodien.app", [
            'page' => "phieunhapxuat.DSphieu",
            'phieu' => $phieu,
            'Trangthai'=> $Trangthai
        ]);
    }

    public function create(){   // Giao diện thêm dữ liệu: GET

        $DCnhapxuat = DCnhapxuat::all();
        $Trangthai = Trangthai::all();
        $Sanpham = Sanpham::all();

        // SELECT p.SOPHIEU, u.TENNV, n.QUANTRI, k.TENKHO
        // FROM phieunhapxuat p, users u, nhansu n, kho k
        // WHERE p.SOPHIEU LIKE 'ADGSG-1118'
        // AND p.MANV = u.MANV
        // AND n.MANV = u.MANV
        // AND n.MAKHO = k.MAKHO

        return view("giaodien.app", 
        [
            'page' => "phieunhapxuat.ViewAddPhieu",
            'DCnhapxuat' => $DCnhapxuat,
            'Trangthai' => $Trangthai,
            'Sanpham' => $Sanpham
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST
        
        $rules = [
            'sophieu' => 'required|alpha|max:20',
            'madiachi' => 'required|numeric',
            'matrangthai' => 'required|numeric',
            'sp.*.slsp' => 'required|numeric',
            'sp.*.idsp' => 'required|numeric|distinct:strict'
        ];

        $mess = [
            'sophieu.required' => 'Chưa nhập thông tin',
            'sophieu.alpha' => 'Vui lòng nhập ký tự chữ cái',
            'sophieu.max' => 'Tối đa 20 kí tự',
            'madiachi.required' => 'Chưa chọn thông tin',
            'matrangthai.required' => 'Chưa chọn thông tin',
            'sp.*.idsp.required' => 'Chưa chọn thông tin',
            'sp.*.idsp.distinct' => 'Không được trùng lặp thông tin',
            'sp.*.slsp.required' => 'Vui lòng nhập số lượng',
            'sp.*.slsp.numeric' => 'Vui lòng nhập chữ số',
        ];

        $request->validate($rules, $mess);

        try {

            $sophieu = $request->sophieu;

            $idnhanvien = Auth::id();

            $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);

            $Trangthai = Trangthai::find($request->matrangthai);

            $makho = $nhanvien->MAKHO;

            // tạo or cập nhật tồn kho
            switch ($Trangthai->TENTT) {

                case 'Xuất':
                    
                    foreach ($request->sp as $key => $value) {

                        $tonkho = Tonkho::where('MAKHO', $makho)
                        ->where('MASP', $value['idsp'])
                        ->first();

                        if (empty($tonkho)) {

                            $sp = Sanpham::find($value['idsp']);

                            Tonkho::create([
                                'MAKHO' => $makho,
                                'MASP' => $value['idsp'],
                                'SLTONKHO' => 0,
                                'SLNHAP' => 0,
                                'SLXUAT' => 0
                            ]);

                            return back()->with('err', 'Hiện chưa có sản phẩm '.$sp->TENSP.' trong kho, vui lòng nhập hàng');
                        }
                        else {

                            if ($tonkho->SLTONKHO < $value['slsp'] || $value['slsp'] <= 0) {

                                $sp = Sanpham::find($value['idsp']);
    
                                return back()->with('err', 'Hiện chỉ còn '.$tonkho->SLTONKHO.' sản phẩm '.$sp->TENSP);
                            }
    
                            Tonkho::where('MAKHO', $makho)
                            ->where('MASP', $value['idsp'])
                            ->update([
                                'SLTONKHO' => $tonkho->SLTONKHO - $value['slsp'],
                                'SLXUAT' => $tonkho->SLXUAT + $value['slsp'],
                            ]);
                        }

                    }

                    break;
                
                default:
                    
                    foreach ($request->sp as $key => $value) {

                        $tonkho = Tonkho::where('MAKHO', $makho)
                        ->where('MASP', $value['idsp'])
                        ->first();

                        if (empty($tonkho)) {
                            Tonkho::create([
                                'MAKHO' => $makho,
                                'MASP' => $value['idsp'],
                                'SLTONKHO' => $value['slsp'],
                                'SLNHAP' => $value['slsp'],
                                'SLXUAT' => 0
                            ]);
                        }
                        else {
                            Tonkho::where('MAKHO', $makho)
                            ->where('MASP', $value['idsp'])
                            ->update([
                                'SLTONKHO' => $tonkho->SLTONKHO + $value['slsp'],
                                'SLNHAP' => $tonkho->SLNHAP + $value['slsp'],
                            ]);
                        }

                    }

                    break;
            }

            // tạo phiếu và chi tiết phiếu
            $idphieu = Phieunhapxuat::insertGetId([
                'SOPHIEU' => $request->sophieu,
                'MANV' => $idnhanvien,
                'MADC' => $request->madiachi,
                'MATT' => $request->matrangthai
            ]);
    
            Phieunhapxuat::where('id', $idphieu)->update(['SOPHIEU' => strtoupper($sophieu).'-'.$idphieu]);

            foreach ($request->sp as $key => $value) {

                $sl = $value['slsp'];
                $sp = Sanpham::find($value['idsp']);
                $gia = $sp->GIASP;
                $dongia = $gia * $sl;
                
                CTnhapxuat::create([
                    'SOLUONG' => $sl, 
                    'DONGIA' => $gia, 
                    'THANHTIEN' => $dongia, 
                    'MAPHIEU' => $idphieu, 
                    'MASP' => $value['idsp']
                ]);

            }

            return back()->with('alert', 'Tạo phiếu '.$Trangthai->TENTT.' thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }
        
    }

    public function show($id){   // Lấy chi tiết của một dữ liệu: GET

        $phieu = Phieunhapxuat::find($id);

        if (empty($phieu)) {
            return back()->with('err', 'Phiếu nhập xuất này không tồn tại');
        } 

        $ctphieu = CTnhapxuat::where('MAPHIEU', $id)->get();
        $sanpham = Sanpham::all();
        $DCnhapxuat = DCnhapxuat::all();
        $Trangthai = Trangthai::all();

        $idnv = Auth::id();
        $nhansu =  Nhansu::firstWhere('MANV', $idnv);
        $nhanvien =  User::firstWhere('MANV', $nhansu->MANV);
        $kho =  Kho::firstWhere('MAKHO', $nhansu->MAKHO);

        return view("giaodien.app", [
            'page' => "phieunhapxuat.CTPhieu",
            'phieu' => $phieu,
            'ctphieu' => $ctphieu,
            'sanpham' => $sanpham,
            'DCnhapxuat' => $DCnhapxuat,
            'Trangthai' => $Trangthai,
            'nhanvien'=> $nhanvien->TENNV,
            'kho' => $kho->TENKHO
        ]);
    }

    public function edit($id){   // Giao diện cập nhật dữ liệu: GET

        $phieu = Phieunhapxuat::find($id);
        $DCnhapxuat = DCnhapxuat::all();

        return view("giaodien.app", [
            'page' => "phieunhapxuat.ViewUpdataPhieu",
            'phieu' => $phieu,
            'DCnhapxuat' => $DCnhapxuat
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        
        $rules = [
            'sophieu' => 'required|alpha|max:20',
            'madiachi' => 'required|numeric',
            'idphieu'=> 'required|numeric'
        ];

        $mess = [
            'sophieu.required' => 'Chưa nhập thông tin',
            'sophieu.alpha' => 'Vui lòng nhập ký tự chữ cái',
            'sophieu.max' => 'Tối đa 20 kí tự',
            'madiachi.required' => 'Chưa chọn thông tin',
            'idphieu.required'=> 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        try {

            // cập nhật phiếu và chi tiết phiếu
            Phieunhapxuat::where('id', $request->idphieu)
                            ->update([
                                'SOPHIEU' => strtoupper($request->sophieu).'-'.$request->idphieu,
                                'MADC' => $request->madiachi
                            ]);

            return back()->with('alert', 'Cập nhật thành công');

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
        }

    }

    public function destroy(Request $request){   // Xóa bỏ một dữ liệu: GET

        $rules = [
            'idphieu' => 'required|numeric'
        ];

        $mess = [
            'idphieu.required' => 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        $phieu = Phieunhapxuat::find($request->idphieu);

        if($phieu){
            $phieu->delete();
            return back()->with('alert', 'Xóa thành công');
        }

        return back()->with('err', 'Không tồn tại dữ liệu cần xóa');
    }

    public function select(Request $request){
        // SELECT *
        // FROM phieunhapxuat p
        // WHERE p.NGAYLAP
        // BETWEEN '2023/11/1' AND '2023/11/30';

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

        // $phieu = Phieunhapxuat::whereBetween('NGAYLAP', [$request->date1, $request->date2])->get();
        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        $phieu = DB::table('phieunhapxuat')
        ->join('users','users.MANV','=','phieunhapxuat.MANV')
        ->join('nhansu','nhansu.MANV','=','users.MANV')
        ->join('kho','kho.MAKHO','=','nhansu.MAKHO')
        ->where('kho.MAKHO', $makho)
        ->whereDate('NGAYLAP', '>=', $request->date1)
        ->whereDate('NGAYLAP', '<=', $request->date2)
        ->select('phieunhapxuat.id','phieunhapxuat.SOPHIEU','phieunhapxuat.MANV','phieunhapxuat.MADC','phieunhapxuat.MATT', 'phieunhapxuat.NGAYLAP')
        ->get();

        $Trangthai = Trangthai::all();

        if(empty($phieu)){
            return back()->with('err', 'Không tồn tại dữ liệu cần lọc');
        }

        return view("giaodien.app", [
            'page' => "phieunhapxuat.DSphieu",
            'phieu' => $phieu,
            'Trangthai'=> $Trangthai
        ]);

    }

    public function exportPDF($id){   // Lấy chi tiết của một dữ liệu: GET

        $phieu = Phieunhapxuat::find($id);

        if (empty($phieu)) {
            return back()->with('err', 'Phiếu nhập xuất này không tồn tại');
        } 

        $ctphieu = CTnhapxuat::where('MAPHIEU', $id)->get();
        $sanpham = Sanpham::all();
        $DCnhapxuat = DCnhapxuat::all();
        $Trangthai = Trangthai::all();

        $idnv = Auth::id();
        $nhansu =  Nhansu::firstWhere('MANV', $idnv);
        $nhanvien =  User::firstWhere('MANV', $nhansu->MANV);
        $kho =  Kho::firstWhere('MAKHO', $nhansu->MAKHO);


        // test
        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate("ID phieu: $id"));


        $pdf = Pdf::loadView('giaodien.export.pdf', [
            'phieu' => $phieu,
            'ctphieu' => $ctphieu,
            'sanpham' => $sanpham,
            'DCnhapxuat' => $DCnhapxuat,
            'Trangthai' => $Trangthai,
            'nhanvien'=> $nhanvien->TENNV,
            'kho' => $kho->TENKHO,
            'qrcode' => $qrcode
        ]);

        return $pdf->stream();
        // return $pdf->download('invoice.pdf');


    }
}
