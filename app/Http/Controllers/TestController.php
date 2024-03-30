<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() 
    {
        return view("home.multi-form");
    }
    public function store(Request $request)
    {
        $request->validate([
            'addMoreInputFields.*.subject' => 'required'
        ]);
     
        dd($request->addMoreInputFields);

        // foreach ($request->addMoreInputFields as $key => $value) {
            // Student::create($value);
        // }
     
        return back()->with('success', 'New subject has been added.'); // thong bao with khoi tao session 
    }


    public function page() 
    {
        return view("giaodien.app", ['page' => "kho"]);
    }


}