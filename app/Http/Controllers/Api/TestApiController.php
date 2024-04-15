<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Nhansu;
use App\Models\Phieunhapxuat;

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

        return response(['message' => 'Retrieved successfully', 'name' => 'danh sach ton kho', 'ton kho' => $thongke], 200);
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

        return response(['message' => 'Retrieved successfully', 'name' => 'danh sach phieu kiem', 'phieu kiem' => $phieu], 200);
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

        return response(['message' => 'Retrieved successfully', 'name' => 'danh sach phieu kiem', 'phieu kiem' => $phieu, 'chitiet' => $phieudata], 200);
    }

    public function testpost(Request $request) {

        $param = $request->param;

        $token = csrf_token();

        return response(['message' => 'Post-test Retrieved successfully', 'param' => $param, 'token' => $token], 200);
    }

    public function testget() {
        return response()->json(['message' => 'Post-test Retrieved successfully'], 200);
    }
}
