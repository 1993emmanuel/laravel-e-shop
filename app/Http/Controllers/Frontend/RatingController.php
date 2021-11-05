<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function addrating(Request $request){
        $stars_rated = $request->input('product_rating');
        $product_id = $request->input('product_id');
        $product_check = Product::where('id',$product_id)->where('status','0')->first();
        if($product_check){
            $verified_purchase = Order::where('orders.user_id',Auth::id())
                ->join('items','order_id','items.order_id')
                ->where('items.product_id',$product_id)->get();
            if($verified_purchase->count() > 0){
                $rating_exist = Rating::where('user_id',Auth::id())->where('product_id',$product_id)->first();
                if( $rating_exist ){
                    $rating_exist->starts_rated = $stars_rated;
                    $rating_exist->update();
                }else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$product_id,
                        'starts_rated'=>$stars_rated
                    ]);
                }
                return redirect()->back()->with('status','Thank you for rating this product');
            }else{
                return redirect()->back()->with('status','You cannot rate this product witout purchase');
            }
        }else{
            return redirect()->back()->with('status','the link was broken sorry');
        }

    }
}
