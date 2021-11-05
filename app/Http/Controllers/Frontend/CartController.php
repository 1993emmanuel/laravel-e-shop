<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if( Auth::check() ){
            $prod_check = Product::where('id',$product_id)->first();
            if( $prod_check ){
                if( Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists() ){
                    return response()->json(['status'=>$prod_check->name.' Already Added to cart']);
                }else{
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status'=>$prod_check->name.' Added to cart']);
                }
            }
        }else{
            return response()->json(['status'=>'Login to Continue with the operation']);
        }
    }

    public function viewcart(){
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.products.cart',compact('cartItems'));
    }

    public function deleteproduct(Request $request){
        if( Auth::check() ){
            $product_id = $request->input('produt_id');
            if( Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists() ){
                $cartItem = Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status'=>'Product Deleted Successfully from the cart']);
            }
        }else{
            return response()->json(['status'=>'login to continue with the operation']);
        }
    }

    public function updatecart(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()){
            if( Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists() ){
                $cart = Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $cart->product_qty = $product_qty;
                $cart->update();
                return response()->json(['status','the produt has been updated in the qty']);
            }
        }else{
            return response()->json(['status'=>'login to continue with the operacion']);
        }

    }

    public function cartcount(){
        $cartcount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartcount]);
    }

}
