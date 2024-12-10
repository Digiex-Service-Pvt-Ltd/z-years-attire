<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $data['featured_categories'] = Category::where('is_featured', 1)->get();
       
        return view('maincontents/home', $data);
    }
    
}
