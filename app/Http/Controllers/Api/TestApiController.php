<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Nhansu;
use App\Models\Phieunhapxuat;
use App\Models\DCnhapxuat;

class TestApiController extends Controller
{
    public function tonkho() {

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        $thongke = DB::table('sanpham')
        ->join('tonkho','tonkho.MASP','=','sanpham.MASP')
        ->join('kho','kho.MAKHO','=','tonkho.MAKHO')
        ->where('kho.MAKHO', $makho)
        ->select('sanpham.MASP','sanpham.TENSP','tonkho.SLNHAP','tonkho.SLXUAT','tonkho.SLTONKHO')
        ->get();

        return response(['message' => 'Retrieved successfully', 'name' => 'danh sach ton kho', 'tonkho' => $thongke, 'errors' => 0], 200);
    }

    public function phieukiem() {

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        $phieu = DB::table('phieunhapxuat')
        ->join('users','users.MANV','=','phieunhapxuat.MANV')
        ->join('nhansu','nhansu.MANV','=','users.MANV')
        ->join('kho','kho.MAKHO','=','nhansu.MAKHO')
        ->join('dcnhapxuat','dcnhapxuat.MADC','=','phieunhapxuat.MADC')
        ->join('trangthai','trangthai.MATT','=','phieunhapxuat.MATT')
        ->where('kho.MAKHO', $makho)
        ->select('phieunhapxuat.id','phieunhapxuat.SOPHIEU','users.TENNV','dcnhapxuat.TENDC','trangthai.TENTT', 'phieunhapxuat.NGAYLAP')
        ->get();

        return response(['message' => 'Retrieved successfully', 'name' => 'danh sach phieu kiem', 'phieu kiem' => $phieu, 'errors' => 0], 200);
    }

    public function phieukiemct($id) {

        $phieu = Phieunhapxuat::find($id);

        if (empty($phieu)) {
            return response(['message' => 'Invalid id'], 200);
        } 

        $idnhanvien = Auth::id();
        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
        $makho = $nhanvien->MAKHO;

        $phieu = DB::table('phieunhapxuat')
        ->join('users','users.MANV','=','phieunhapxuat.MANV')
        ->join('nhansu','nhansu.MANV','=','users.MANV')
        ->join('kho','kho.MAKHO','=','nhansu.MAKHO')
        ->join('dcnhapxuat','dcnhapxuat.MADC','=','phieunhapxuat.MADC')
        ->join('trangthai','trangthai.MATT','=','phieunhapxuat.MATT')
        ->where('kho.MAKHO', $makho)
        ->where('phieunhapxuat.id', $id)
        ->select('phieunhapxuat.id','phieunhapxuat.SOPHIEU','users.TENNV','dcnhapxuat.TENDC','trangthai.TENTT', 'phieunhapxuat.NGAYLAP')
        ->get();

        $phieudata = DB::table('phieunhapxuat')
        ->join('users','users.MANV','=','phieunhapxuat.MANV')
        ->join('nhansu','nhansu.MANV','=','users.MANV')
        ->join('kho','kho.MAKHO','=','nhansu.MAKHO')
        ->join('ct_nhapxuat','ct_nhapxuat.MAPHIEU','=','phieunhapxuat.id')
        ->join('sanpham','sanpham.MASP','=','ct_nhapxuat.MASP')
        ->where('kho.MAKHO', $makho)
        ->where('ct_nhapxuat.MAPHIEU', $id)
        ->select('sanpham.MASP','sanpham.TENSP','ct_nhapxuat.SOLUONG','ct_nhapxuat.DONGIA','ct_nhapxuat.THANHTIEN')
        ->get();

        return response(['message' => 'Retrieved successfully', 'name' => 'danh sach phieu kiem', 'phieu kiem' => $phieu, 'chitiet' => $phieudata, 'errors' => 0], 200);
    }

    public function testpost(Request $request) {

        $data = $request->json()->all();

        return response(['message' => 'Post-test Retrieved successfully', 'data' => $data['object'][0]['sl']], 200);
    }

    public function getdiachi() {
        $diachi = DCnhapxuat::all();
        return response()->json(['message' => 'Post-test Retrieved successfully', 'diachi' => $diachi, 'errors' => 0], 200);
    }
}
