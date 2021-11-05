<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $featured_products = Product::where('trending','1')->take(15)->get();
        $trending_categories = Category::where('popular','1')->take(15)->get();
        return view('frontend.index',compact('featured_products','trending_categories'));
    }

    public function category(){
        $categories = Category::where('status','0')->get();
        return view('frontend.category',compact('categories'));
    }

    public function viewcategory($slug){
        if( Category::where('slug',$slug)->exists() ){
            $category = Category::where('slug',$slug)->first();
            $products = Product::Where('cate_id',$category->id)->where('status','0')->get();
            return view('frontend.products.index',compact('category','products'));
        }else{
            return redirect('/')->with('status','Slug doesnt exists');
        }
    }

    public function productview($cate_slug, $product_slug){
        if( Category::where('slug',$cate_slug)->exists() ){
            if( Product::where('slug',$product_slug)->exists() ){
                $products = Product::where('slug',$product_slug)->first();
                $rating = Rating::where('product_id',$products->id)->get();
                $rating_sum = Rating::where('product_id',$products->id)->sum('starts_rated');
                $user_rating = Rating::where('product_id',$products->id)->where('user_id',Auth::id())->first();
                if($rating->count() > 0 ){
                    $rating_value = $rating_sum/$rating->count();
                }else{
                    $rating_value = 0;
                }
                return view('frontend.products.view',compact('products','rating','rating_value','user_rating'));
            }else{
                return redirect()->with('status', 'the link was broken');
            }
        }else{
            return redirect()->with('status','no such category found');
        }
    }

}
