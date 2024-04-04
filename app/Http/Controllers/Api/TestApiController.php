<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function index() {
        return response(['message' => 'Test Retrieved successfully'], 200);
    }

    public function testpost(Request $request) {

        $param = $request->param;

        return response(['message' => 'Test Retrieved successfully', 'param' => $param], 200);
    }
}
