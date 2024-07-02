<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, SubCategory};
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
  public function index()
  {
    $allsubcategories = SubCategory::latest()->get();
    return view('admin.allsubcategory', compact('allsubcategories'));
  }
  public function addSubCategory()
  {
    $categories = Category::latest()->get();
    return view('admin.addsubcategory', compact('categories'));
  }
  public function storeSubCategory(Request $request)
  {
    $request->validate([
      'subcategory_name' => 'required|unique:sub_categories',
      'category_id' => 'required'
    ]);

    $category_id = $request->category_id;

    $category_name = Category::where('id', $category_id)->value('category_name');

    SubCategory::insert([
      'subcategory_name' => $request->subcategory_name,
      'slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
      'category_id' => $category_id,
      'category_name' => $category_name
    ]);

    Category::where('id', $category_id)->increment('subcategory_count', 1);

    return redirect()->route('allsubcategory')->with('message', 'Sub Category Added Successfully!');
  }
  public function editSubCat($id)
  {
    $subcatinfo = SubCategory::findOrFail($id);

    return view('admin.editsubcat', compact('subcatinfo'));
  }
  public function updateSubCat(Request $request)
  {
    $request->validate([
      'subcategory_name' => 'required|unique:sub_categories',
    ]);

    $subcatid = $request->subcatid;

    SubCategory::findOrFail($subcatid)->update([
      'subcategory_name' => $request->subcategory_name,
      'slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
    ]);

    return redirect()->route('allsubcategory')->with('message', 'Sub Category Updated Successfully!');
  }
  public function deleteSubCat($id)
  {
    $cat_id = SubCategory::where('id', $id)->value('category_id');
    SubCategory::findOrFail($id)->delete();

    Category::where('id', $cat_id)->decrement('subcategory_count', 1);

    return redirect()->route('allsubcategory')->with('message', 'Sub Category Deleted Successfully!');
  }
}
