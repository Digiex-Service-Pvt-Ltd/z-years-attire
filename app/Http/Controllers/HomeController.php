<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $data['featured_categories'] = Category::where('is_featured', 1)->get();
        $data['latest_products'] = Product::where(['parent_id'=>0, "status"=>1])->orderBy('id', 'DESC')->take(12)->get();
        //dd($data['latest_products']);
        return view('maincontents/home', $data);
    }
    
}
