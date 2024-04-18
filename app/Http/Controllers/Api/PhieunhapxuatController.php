<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Phieunhapxuat;
use App\Models\Sanpham;
use App\Models\CTnhapxuat;
use App\Models\Nhansu;
use App\Models\DCnhapxuat;
use App\Models\Tonkho;


class PhieunhapxuatController extends Controller
{
    public function show($id){   // Lấy chi tiết của một dữ liệu: GET

        try {
            $phieu = Phieunhapxuat::find($id);

            if (empty($phieu)) {
                return response(['message' => 'Phiếu nhập xuất này không tồn tại', 'errors' => 1], 200);
            } 

            $ctphieu = CTnhapxuat::where('MAPHIEU', $id)->get();

            $data_form = array();

            for ($i=0; $i < count($ctphieu); $i++) { 
                $data_tamp = ["MASP" => $ctphieu[$i]['MASP'], "SOLUONG" => $ctphieu[$i]['SOLUONG']];
                array_push($data_form, $data_tamp);
            }

            return response(['message' => 'Retrieved successfully', 'errors' => 0, 'phieu' => $phieu, 'ctphieu' => $ctphieu, 'data_form' => $data_form], 200);

        } catch (Exception $err) {
            return response(['message' => $err->getMessage(), 'errors' => 1], 200);
        }
        
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST 

        $validator = Validator::make($request->all(), [
            'sophieu' => 'required|alpha|max:20',
            'madiachi' => 'required|numeric',
            'info_sp' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->errors(), 'errors' => 1], 200);
        }

        // check id sp
        for ($i = 0; $i < count($request->info_sp); $i++) {

            if (!is_int($request->info_sp[$i]['MASP'])) {
                return response(['message' => 'ID sản phẩm '.$request->info_sp[$i]['MASP'].' không phải định dạng số nguyên', 'errors' => 1], 200);
            }

            $checkid = $sp = Sanpham::find($request->info_sp[$i]['MASP']);

            if (empty($checkid)) {
                return response(['message' => 'ID sản phẩm '.$request->info_sp[$i]['MASP'].' không tồn tại', 'errors' => 1], 200);
            }


            $sluong = $request->info_sp[$i]['SOLUONG'];
            if (empty($sluong)) {
                return response(['message' => 'ID sản phẩm '.$request->info_sp[$i]['MASP'].' thiếu thông tin số lượng sản phẩm', 'errors' => 1], 200);
            }
            if (!is_int($sluong)) {
                return response(['message' => 'ID sản phẩm '.$request->info_sp[$i]['MASP'].' số lượng không phải định dạng số nguyên', 'errors' => 1], 200);
            }
        }

         // check id dia chi
        $checkidDC = DCnhapxuat::find($request->madiachi);
        if (empty($checkidDC)) {
            return response(['message' => 'ID địa chỉ '.$request->madiachi.' không tồn tại', 'errors' => 1], 200);
        }

        try {

            $sophieu = $request->sophieu;
            
            $idnhanvien = Auth::id();
            $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);
            $makho = $nhanvien->MAKHO;

            // tạo or cập nhật tồn kho 
            for ($i = 0; $i < count($request->info_sp); $i++) { 

                $tonkho = Tonkho::where('MAKHO', $makho)
                ->where('MASP', $request->info_sp[$i]['MASP'])
                ->first();

                if (empty($tonkho)) {
                    Tonkho::create([
                        'MAKHO' => $makho,
                        'MASP' => $request->info_sp[$i]['MASP'],
                        'SLTONKHO' => $request->info_sp[$i]['SOLUONG'],
                        'SLNHAP' => $request->info_sp[$i]['SOLUONG'],
                        'SLXUAT' => 0
                    ]);
                }
                else {
                    Tonkho::where('MAKHO', $makho)
                    ->where('MASP', $request->info_sp[$i]['MASP'])
                    ->update([
                        'SLTONKHO' => $tonkho->SLTONKHO + $request->info_sp[$i]['SOLUONG'],
                        'SLNHAP' => $tonkho->SLNHAP + $request->info_sp[$i]['SOLUONG'],
                    ]);
                }

            }

            // tạo phiếu 
            $idphieu = Phieunhapxuat::insertGetId([
                'SOPHIEU' => $request->sophieu,
                'MANV' => $idnhanvien,
                'MADC' => $request->madiachi,
                'MATT' => 1111
            ]);
    
            Phieunhapxuat::where('id', $idphieu)->update(['SOPHIEU' => strtoupper($sophieu).'-'.$idphieu]);

            // tạo chi tiết phiếu
            for ($i = 0; $i < count($request->info_sp); $i++) { 

                $sl = $request->info_sp[$i]['SOLUONG'];
                $sp = Sanpham::find($request->info_sp[$i]['MASP']);
                $gia = $sp->GIASP;
                $dongia = $gia * $sl;
                
                CTnhapxuat::create([
                    'SOLUONG' => $sl, 
                    'DONGIA' => $gia, 
                    'THANHTIEN' => $dongia, 
                    'MAPHIEU' => $idphieu, 
                    'MASP' => $request->info_sp[$i]['MASP']
                ]);

            }

            return response(['message' => 'Tạo phiếu thành công', 'errors' => 0], 200);

        } catch (Exception $err) {
            return response(['message' => $err->getMessage(), 'errors' => 1], 200);
        }
        
    }

}
