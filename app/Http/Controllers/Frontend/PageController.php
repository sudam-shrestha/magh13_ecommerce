<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Shop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EmailNotification;
use App\Models\Admin;
use App\Models\ShopProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }



    public function shop_request(Request $request)
    {
        $request->validate([
            "name" => "required|max:50",
            "email" => "required|email|max:50|unique:shops",
            "contact" => "required|digits_between:10,15|unique:shop_profiles",
            "address" => "required|max:50",
            "shop_name" => "required|max:50",
        ]);

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->email = $request->email;
        $shop->password = Hash::make(rand(10000, 99999));
        $shop->save();

        $profile = new ShopProfile();
        $profile->shop_name = $request->shop_name;
        $profile->contact = $request->contact;
        $profile->address = $request->address;
        $profile->shop_id = $shop->id;
        $profile->save();

        $data = [
            "subject" => "Shop Request",
            "name" => $request->name,
            "shop_name" => $request->shop_name,
            "contact" => $request->contact,
            "address" => $request->address,
            "review_link" => url('/admin'),
        ];

        $admins = Admin::all();
        Mail::to($admins)->send(new EmailNotification($data));

        toast("Shop Request Sent Successfully", "success");

        return redirect()->route('home');
    }
}
