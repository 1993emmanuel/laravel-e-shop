<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlists = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlists'));
    }

    public function addtowishlist(Request $request){
        if( Auth::check() ){
            $product_id = $request->input('product_id');
            if( Product::find($product_id) ){
                $wish = new Wishlist();
                $wish->product_id = $product_id;
                $wish->user_id  = Auth::id();
                $wish->save();
                return response()->json(['status'=>'The product has been added to you wishlist']);
            }else{
                return response()->json(['status'=>'Opps the product does not exist']);
            }
        }else{
            return response()->json(['status'=>'You need be login to continue...']);
        }
    }

    public function removewishlist(Request $request){
        if( Auth::check() ){
            $product_id = $request->input('produt_id');
            if( Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->exists() ){
                $wish = Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $wish->delete();
                return response()->json(['status'=>'the product was removed for you wish list']);
            }
            // else{
            //     return response()->json(['status'=>'this article doesnt exist in you wishlist']);
            // }
        }else{
            return response()->json(['status'=>'you need be login to continue.....']);
        }
    }

    public function wishlistcount(){
        $wishcount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishcount]);
    }

}
