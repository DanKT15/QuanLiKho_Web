<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Phieunhapxuat;
use App\Models\Sanpham;
use App\Models\CTnhapxuat;
use App\Models\Tonkho;
use App\Models\User;
use App\Models\Nhansu;

class dashboard extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET

        $idnhanvien = Auth::id();

        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);

        $makho = $nhanvien->MAKHO;

        // cot
        $data_Cot_nhap = [];
        $data_Cot_xuat = [];

        // tron
        $data_tron = [];

        // duong

        $data_duong = [];


        for ($i=1; $i <= 12; $i++) { 
            
            $thongtinNX = DB::table('phieunhapxuat')
            ->join('ct_nhapxuat','ct_nhapxuat.MAPHIEU','=','phieunhapxuat.id')
            ->join('sanpham','sanpham.MASP','=','ct_nhapxuat.MASP')
            ->join('trangthai','trangthai.MATT','=','phieunhapxuat.MATT')
            ->join('tonkho','tonkho.MASP','=','sanpham.MASP')
            ->join('kho','kho.MAKHO','=','tonkho.MAKHO')
            ->where('kho.MAKHO', $makho)
            ->WhereMonth('phieunhapxuat.NGAYLAP', $i)
            ->select('sanpham.MASP','sanpham.TENSP','ct_nhapxuat.SOLUONG','phieunhapxuat.NGAYLAP','trangthai.TENTT')
            ->get();

            if (!empty($thongtinNX)) {

                $tongnhap = 0;
                $tongxuat = 0;

                foreach ($thongtinNX as $value) {
                    
                    if ($value->TENTT === 'Nhập') {
                        $tongnhap += $value->SOLUONG;
                    } else {
                        $tongxuat += $value->SOLUONG;
                    }

                }

                array_push($data_Cot_nhap, $tongnhap);
                array_push($data_Cot_xuat, $tongxuat);

            }
            else {
                array_push($data_Cot_nhap, 0);
                array_push($data_Cot_xuat, 0);
            }

        }


        $soluongsanpham = DB::table('sanpham')
        ->join('tonkho','tonkho.MASP','=','sanpham.MASP')
        ->join('kho','kho.MAKHO','=','tonkho.MAKHO')
        ->where('kho.MAKHO', $makho)
        ->select('sanpham.MASP','sanpham.TENSP','tonkho.SLTONKHO','tonkho.SLNHAP','tonkho.SLXUAT')
        ->get();

        $tongsanpham = 0;

        foreach ($soluongsanpham as $value) {
            $tongsanpham += $value->SLTONKHO;
        }

        foreach ($soluongsanpham as $value) {

            $phantramsp = $value->SLTONKHO/($tongsanpham)*100;

            array_push($data_tron, array('y' => ceil($phantramsp), 'label' => $value->TENSP));
            array_push($data_duong, array('label' => $value->TENSP, 'y' => $value->SLTONKHO));

        }

        return view("giaodien.app", [
            'page' => "dashboard",
            'data_BD_Cot_xuat' => $data_Cot_xuat,
            'data_BD_Cot_nhap' => $data_Cot_nhap,
            'data_tron' => $data_tron,
            'data_duong' => $data_duong
        ]);
    }

}
