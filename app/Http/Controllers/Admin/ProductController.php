<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, SubCategory, Product};
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
  {
    $products = Product::latest()->get();
    return view('admin.allproduct', compact("products"));
  }

  public function addProduct()
  {
    $categories = Category::latest()->get();
    $subcategories = SubCategory::latest()->get();

    return view('admin.addproduct', compact('categories', 'subcategories'));
  }
  public function storeProduct(Request $request)
  {
    $request->validate([
      'product_name' => 'required|unique:products',
      'product_short_des' => 'required',
      'product_long_des' => 'required',
      'price' => 'required',
      'quantity' => 'required',
      'product_category_id' => 'required',
      'product_subcategory_id' => 'required',
      'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $img = $request->file('product_img');
    $img_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
    $request->product_img->move(public_path('upload'), $img_name);
    $img_url = 'upload/' . $img_name;

    $category_id = $request->product_category_id;
    $subcategory_id = $request->product_subcategory_id;

    $category_name = Category::where('id', $category_id)->value('category_name');
    $subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');

    Product::insert([
      'product_name' => $request->product_name,
      'slug' => strtolower(str_replace(' ', '_', $request->product_name)),
      'price' => $request->price,
      'quantity' => $request->quantity,
      'product_short_des' => $request->product_short_des,
      'product_long_des' => $request->product_long_des,
      'product_category_name' => $category_name,
      'product_subcategory_name' => $subcategory_name,
      'product_category_id' => $request->product_category_id,
      'product_subcategory_id' => $request->product_subcategory_id,
      'product_img' => $img_url,
    ]);

    Category::where('id', $category_id)->increment('product_count', 1);
    SubCategory::where('id', $subcategory_id)->increment('product_count', 1);

    return redirect()->route('allproduct')->with('message', 'Product Added Successfully!');
  }
  public function editProductImg($id)
  {
    $product_info = Product::findOrFail($id);
    return view('admin.editproductimg', compact('product_info'));
  }
  public function updateProductImg(Request $request)
  {
    $request->validate([
      'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $id = $request->id;
    $img = $request->file('product_img');
    $img_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
    $request->product_img->move(public_path('upload'), $img_name);
    $img_url = 'upload/' . $img_name;

    Product::findOrFail($id)->update([
      'product_img' => $img_url,
    ]);

    return redirect()->route('allproduct')->with('message', 'Product Image Updated Successfully!');
  }
  public function editProduct($id)
  {
    $product_info = Product::findOrFail($id);
    return view('admin.editproduct', compact('product_info'));
  }
  public function updateProduct(Request $request)
  {
    $productid = $request->id;
    $request->validate([
      'product_name' => 'required:unique',
      'price' => 'required',
      'quantity' => 'required',
      'product_short_des' => 'required',
      'product_long_des' => 'required'
    ]);

    Product::findOrFail($productid)->update([
      'product_name' => $request->product_name,
      'product_short_des' => $request->product_short_des,
      'product_long_des' => $request->product_long_des,
      'price' => $request->price,
      'quantity' => $request->quantity,
      'slug' => strtolower(str_replace(' ', '_', $request->product_name))
    ]);

    return redirect()->route('allproduct')->with('message', 'Product Updated Successfully!');
  }
  public function deleteProduct($id)
  {
    $product = Product::where('id', $id)->first();
    Product::findOrFail($id)->delete();

    Category::where('id', $product->product_category_id)->decrement('product_count', 1);
    SubCategory::where('id', $product->product_subcategory_id)->decrement('product_count', 1);

    return redirect()->route('allproduct')->with('message', 'Product Deleted Successfully!');
  }
}
