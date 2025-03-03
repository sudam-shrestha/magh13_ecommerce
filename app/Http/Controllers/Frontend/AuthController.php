<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDescription;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function google_login()
    {
        return Socialite::driver('google')->redirect();
    }


    public function google_callback()
    {
        $user = Socialite::driver('google')->user();

        $oldUser = User::where('email', $user->email)->first();
        if ($oldUser) {
            Auth::login($oldUser);
            return redirect('/');
        }

        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->password = Hash::make(uniqid());
        $newUser->save();
        Auth::login($newUser);
        return redirect('/');
    }


    public function cart_store(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = new Cart();
        $cart->product_id = $product->id;
        $cart->amount = $product->discount ? $request->qty * ($product->price - $product->discount * $product->price / 100) : $request->qty * $product->price;
        $cart->user_id = Auth::user()->id;
        $cart->qty = $request->qty;
        $cart->save();
        toast("Product added to cart", "success");
        return redirect()->back();
    }


    public function carts()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('frontend.carts', compact('carts'));
    }

    public function update_cart($id)
    {
        $cart = Cart::findOrFail($id);
        if ($cart->user_id !== Auth::user()->id) {
            return response()->json(['success' => false], 403);
        }
        $cart->qty = request('qty');
        $cart->save();
        return response()->json(['success' => true]);
    }

    public function remove_cart($id)
    {
        try {
            $cart = Cart::findOrFail($id);

            if ($cart->user_id !== Auth::user()->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $cart->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cart deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete cart'
            ], 500);
        }
    }


    public function check_out($id)
    {
        $all_carts = Cart::where('user_id', Auth::user()->id)->get();
        $carts = [];
        $total = 0;
        foreach ($all_carts as $cart) {
            if ($cart->product->shop_id == $id) {
                $carts[] = $cart;
                $total += $cart->amount * $cart->qty;
            }
        }
        return view('frontend.checkout', compact('carts', 'total', 'id'));
    }

    public function order_store(Request $request)
    {
        // return $request;
        $order = new Order();
        $order->total_amount = $request->total_amount;
        $order->shop_id = $request->shop_id;
        $order->payment_type = $request->payment_type;
        $order->user_id = Auth::user()->id;
        $order->save();

        $all_carts = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($all_carts as $cart) {
            if ($cart->product->shop_id == $request->shop_id) {
                $orderDes = new OrderDescription();
                $orderDes->order_id = $order->id;
                $orderDes->product_id = $cart->product_id;
                $orderDes->amount = $cart->amount;
                $orderDes->qty = $cart->qty;
                $orderDes->save();
                $cart->delete();
            }
        }

        toast("Order placed successfully!", "success");
        return redirect()->back();
    }
}
