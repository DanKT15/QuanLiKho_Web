<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use App\Models\User;
use App\Models\Kho;
use App\Models\Nhansu;

class UserController extends Controller
{
    public function index(){   // Giao diện hiển thị toàn bộ dữ liệu: GET

        // SELECT u.MANV, u.TENNV, u.GIOITINH, k.TENKHO, n.QUANTRI
        // FROM nhansu n
        // INNER JOIN kho k ON k.MAKHO = n.MAKHO
        // INNER JOIN users u ON u.MANV = n.MANV;

        $idnhanvien = Auth::id();

        $nhanvien =  Nhansu::firstWhere('MANV', $idnhanvien);

        $makho = $nhanvien->MAKHO;

        $User = DB::table('nhansu')
            ->join('users','nhansu.MANV','=','users.MANV')
            ->join('kho','nhansu.MAKHO','=','kho.MAKHO')
            ->Where('kho.MAKHO', $makho)
            ->select('users.MANV','users.TENNV','users.GIOITINH','kho.TENKHO','nhansu.QUANTRI')
            ->get();
        ;

        return view("giaodien.app", [
            'page' => "User.DSuser",
            "User"=> $User,
        ]);

        // return response('Tạo tài khoản thành công: ' , 200);

    }

    public function create(){   // Giao diện thêm dữ liệu: GET

        $kho = Kho::all();

        return view("giaodien.app", [
            'page' => "User.ViewAddUser",
            "kho"=> $kho
        ]);
    }

    public function store(Request $request){   // Lưu trữ dữ liệu mới: POST

        $rules = [
            'TENNV' => 'required|regex:/[[:alpha:]]/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|max:32',
            'SDT' => 'required|numeric',
            'DC' => 'required|regex:/[[:alpha:]]/',
            'GIOITINH' => 'required|alpha',
            'KHO' => 'required|numeric',
            'QUYEN' => 'required|alpha',
            'HINHANH' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $mess = [
            'TENNV.required' => 'Chưa nhập thông tin',
            'TENNV.regex' => 'Vui lòng nhập ký tự chữ cái',

            'SDT.required' => 'Chưa chọn thông tin',
            'SDT.numeric' => 'Vui lòng nhập chữ số',

            'KHO.required' => 'Chưa chọn thông tin',
            'KHO.numeric' => 'Vui lòng nhập chữ số',

            'QUYEN.required' => 'Chưa chọn thông tin',
            'QUYEN.alpha' => 'Vui lòng nhập ký tự chữ cái',

            'DC.required' => 'Chưa nhập thông tin',
            'DC.regex' => 'Vui lòng nhập ký tự chữ cái',

            'GIOITINH.required'=> 'Chưa chọn thông tin',
            'GIOITINH.alpha'=> 'Vui lòng nhập ký tự chữ cái',

            'email.required' => 'Chưa nhập thông tin',
            'email.string' => 'Vui lòng nhập ký tự chữ cái',
            'email.email' => 'Vui lòng nhập đúng chú pháp email',
            'email.max'=> 'Chiều dài tối đa 255 ký tự',
            'email.unique'=> 'Email đã được đăng ký',

            'password.required' => 'Chưa nhập thông tin',
            'password.max'=> 'Chiều dài tối đa 32 ký tự',
            'password.min'=> 'Chiều dài tối thiểu 8 ký tự',

            'HINHANH.required'=> 'Vui lòng tải ảnh lên hệ thống',
            'HINHANH.mimes'=> 'Vui lòng chọn file định dạng ảnh',
        ];

        $request->validate($rules, $mess);

        try {

            $user = User::where('email', $request->email)->first();

            if (!empty($user)) {
                return back()->with('err', 'Lỗi: Email đã được đăng ký');
            }

            if($request->file('HINHANH')) {

                $image = $request->file('HINHANH');
                $storedPath = $image->move('images', $request->file('HINHANH')->getClientOriginalName());

            }

            $iduser = User::insertGetId([
                'TENNV' => $request->TENNV,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'SDT' => $request->SDT,
                'DC' => $request->DC,
                'GIOITINH' => $request->GIOITINH,
                'HINHANH' =>  $request->file('HINHANH')->getClientOriginalName(),
            ]);

            Nhansu::create([
                'MANV' => $iduser,
                'MAKHO' => $request->KHO,
                'QUANTRI' => $request->QUYEN,
            ]);

            return back()->with('alert', 'Tạo tài khoản thành công');
            
            // return response('Tạo tài khoản thành công: '.$request->SDT , 200);

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
            // return response('Lỗi: '.$err->getMessage(), 401);
        }
    }

    public function show($id){   // Lấy chi tiết của một dữ liệu: GET

        $User = DB::table('nhansu')
            ->join('users','nhansu.MANV','=','users.MANV')
            ->join('kho','nhansu.MAKHO','=','kho.MAKHO')
            ->select('users.MANV','users.TENNV', 'users.SDT', 'users.email', 'users.password', 'users.DC', 'users.HINHANH','users.GIOITINH','kho.TENKHO','nhansu.QUANTRI')
            ->where('users.MANV','=', $id)
            ->get();
        ;

        if (empty($User)) {
            return back()->with('err', 'Tài khoản này không tồn tại');
        } 
        
        return view("giaodien.app", [
            'page' => "User.CTUser",
            'User'=> $User
        ]);
    }

    public function edit($id){   // Giao diện cập nhật dữ liệu: GET

        $User = DB::table('nhansu')
            ->join('users','nhansu.MANV','=','users.MANV')
            ->join('kho','nhansu.MAKHO','=','kho.MAKHO')
            ->select('users.MANV','users.TENNV', 'users.SDT', 'users.email', 'users.password', 'users.DC', 'users.HINHANH','users.GIOITINH','kho.MAKHO','nhansu.QUANTRI')
            ->where('users.MANV','=', $id)
            ->get();
        ;

        $kho = Kho::all();

        return view("giaodien.app", [
            'page' => "User.ViewUpdataUser",
            "user"=> $User,
            "kho"=> $kho
        ]);
    }

    public function update(Request $request){   // Cập nhật lại dữ liệu: POST
        $rules = [
            'MANV' => 'required|numeric',
            'TENNV' => 'required|regex:/[[:alpha:]]/',
            'password' => 'required|min:8',
            'SDT' => 'required|numeric',
            'DC' => 'required|regex:/[[:alpha:]]/',
            'GIOITINH' => 'required|alpha',
            'KHO' => 'required|numeric',
            'QUYEN' => 'required|alpha',
            'HINHANH' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $mess = [
            'TENNV.required' => 'Chưa nhập thông tin',
            'TENNV.regex' => 'Vui lòng nhập ký tự chữ cái',

            'SDT.required' => 'Chưa chọn thông tin',
            'SDT.numeric' => 'Vui lòng nhập chữ số',

            'KHO.required' => 'Chưa chọn thông tin',
            'KHO.numeric' => 'Vui lòng nhập chữ số',

            'QUYEN.required' => 'Chưa chọn thông tin',
            'QUYEN.alpha' => 'Vui lòng nhập ký tự chữ cái',

            'DC.required' => 'Chưa nhập thông tin',
            'DC.regex' => 'Vui lòng nhập ký tự chữ cái',

            'GIOITINH.required'=> 'Chưa chọn thông tin',
            'GIOITINH.alpha'=> 'Vui lòng nhập ký tự chữ cái',

            'password.required' => 'Chưa nhập thông tin',
            'password.min'=> 'Chiều dài tối thiểu 8 ký tự',

            'HINHANH.mimes'=> 'Vui lòng chọn file định dạng ảnh',
        ];

        $request->validate($rules, $mess);

        try {

            $user = User::where('email', $request->email)->first();

            if (!empty($user)) {
                return back()->with('err', 'Lỗi: Email đã được đăng ký');
            }

            if($request->file('HINHANH')) {

                $image = $request->file('HINHANH');
                $imagename = $image->getClientOriginalName();
                $storedPath = $image->move('images', $imagename);

            }
            else {
                $imagename = $request->OLDHINHANH;
            }

            User::where('MANV', $request->MANV)
            ->update([
                'TENNV' => $request->TENNV,
                'password' => Hash::make($request->password),
                'SDT' => $request->SDT,
                'DC' => $request->DC,
                'GIOITINH' => $request->GIOITINH,
                'HINHANH' =>  $imagename,
            ]);

            Nhansu::where('MANV', $request->MANV)
            ->update([
                'MAKHO' => $request->KHO,
                'QUANTRI' => $request->QUYEN,
            ]);

            return back()->with('alert', 'Cập nhật tài khoản thành công');
            
            // return response('Tạo tài khoản thành công: '.$request->SDT , 200);

        } catch (Exception $err) {
            return back()->with('err', 'Lỗi: '.$err->getMessage());
            // return response('Lỗi: '.$err->getMessage(), 401);
        }
    }

    public function destroy(Request $request){   // Xóa bỏ một dữ liệu: GET
        $rules = [
            'MANV' => 'required|numeric'
        ];

        $mess = [
            'MANV.required' => 'Chưa có id thông tin'
        ];

        $request->validate($rules, $mess);

        if (Auth::id() == $request->MANV) {
            return back()->with('err', 'Tài khoản này đang được sử dụng, không thể xóa');
        }

        $nhanvien = User::findOrFail($request->MANV);
        $image_path = app_path("../public/images/{$nhanvien->HINHANH}");

        if($nhanvien){

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $nhanvien->delete();
            return back()->with('alert', 'Xóa thành công');
        }

        return back()->with('err', 'Không tồn tại dữ liệu cần xóa');
        
    }
}
