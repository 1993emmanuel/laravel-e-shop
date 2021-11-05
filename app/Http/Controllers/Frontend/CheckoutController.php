<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $old_cartitems = Cart::where('user_id',Auth::id())->get();
        foreach( $old_cartitems as $item )
        {
            if(! Product::where('id',$item->product_id)->where('qty','>=',$item->product_qty)->exists())
            {   
                $removeItem = Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartitems'));
    }

    public function placeorder(Request $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');

        // to Calculate the total price
        $total = 0;
        $cartitemstotal = Cart::where('user_id',Auth::id())->get();
        foreach( $cartitemstotal as $prod ){
            $total += $prod->products->selling_price;
        }
        $order->total_price = $total;
        $order->tracking_no = 'EorderE'.rand(1111,9999);
        $order->save();
        
        $cartitems = Cart::where('user_id',Auth::id())->get();
        foreach( $cartitems as $item ){
            OderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' =>  $item->product_qty,
                'price' => $item->products->selling_price
            ]);
            $prod = Product::where('id',$item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }

        if( Auth::user()->address1 == NULL ){
            $user = User::where('id',Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            // $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }

        $cartItems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartItems);

        return redirect('/')->with('status','Order placed successfully');
    }

}