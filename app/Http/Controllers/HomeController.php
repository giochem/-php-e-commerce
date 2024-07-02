<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $printThisNumber = number_format("30000000", 0, '.', ',');
        // dd($printThisNumber);
        $allproduct = Product::latest()->orderBy('product_category_id', 'desc')->get();


        return view('user.home', compact('allproduct'));
    }
}
