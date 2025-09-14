<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Middleware\fontendMiddleware;

class CartController extends Controller
{
    public function add($product_id)
        {
            // if (!Auth::guard('customer')->check()) {
            //     return redirect()->route('customer.login')->with('error', 'Please login as customer to add to cart.');
            // }

            $customer_id = Auth::guard('customer')->id();


            $existing = Cart::where('customer_id', $customer_id)
                            ->where('product_id', $product_id)
                            ->first();

            if ($existing) {
                $existing->quantity += 1;
                $existing->save();
            } else {
                Cart::create([
                    'customer_id' => $customer_id,
                    'product_id' => $product_id,
                ]);
            }

            return redirect()->back()->with('success', 'Product added to cart.');
        }


        public function cartView(){
            $products = Cart::with('product')->get();
            return view('cart.cartView',compact('products'));
        }

        function cartdelete($id){
        Cart::find($id)->delete();
        return back();
    }

   public function singlecart($id)
{
    $cartItem = Cart::with('product')->get();
    return view('cart.singleProduct', compact('cartItem'));
}


}
