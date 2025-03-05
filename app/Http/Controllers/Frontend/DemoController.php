<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DemoController extends Controller
{
    public function demo()
    {
        $response = Http::get('http://192.168.18.63:8000/api/categories');
        $categories = $response['data'];
        return view('api', compact('categories'));
    }


    public function post(Request $request)
    {
        $token = "token from cookies";
        $response = Http::withHeader([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('http://192.168.18.63:8000/api/demo', [
            'name' => $request->name,
        ]);
        if ($response['success'] == true) {
            return $response['message'];
        }
        return "error";
    }
}
