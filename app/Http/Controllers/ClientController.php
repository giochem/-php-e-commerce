<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{Category, Product, Cart, ShippingInfo, Order};

class ClientController extends Controller
{
  public function categoryPage($id)
  {
    $category = Category::findOrFail($id);
    $products = Product::where("product_category_id", $id)->latest()->get();

    return view('user.category', compact('category', 'products'));
  }
  public function singleProduct($id, $slug)
  {
    $product = Product::findOrFail($id);
    $subcat_id = Product::where("id", $id)->value('product_subcategory_id');
    $related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();

    return view('user.product', compact('product', 'related_products'));
  }
  public function addToCart()
  {
    $user_id = Auth::id();
    $cart_items = Cart::where('user_id', $user_id)->get();
    return view('user.addtocart', compact('cart_items'));
  }
  public function addProductToCart(Request $request)
  {

    $quantity = $request->quantity;
    $price = $request->price * $quantity;
    $cart_exist = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->exists();
    if ($cart_exist) {
      $old_cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
      $quantity = $old_cart->quantity + $quantity;
      $price = $old_cart->price + $price;

      Cart::where('id', $old_cart->id)->update([
        'quantity' => $quantity,
        'price' => $price,
      ]);
    } else {
      Cart::insert([
        'product_id' => $request->product_id,
        'user_id' => Auth::id(),
        'quantity' => $quantity,
        'price' => $price,
      ]);
    }
    return redirect()->route('addtocart')->with('message', 'Your item added to cart successfully!');
  }
  public function editCartItem($id)
  {
    $item = Cart::findOrFail($id)->first();
    return view('user.editcartitem', compact('item'));
  }
  public function updateCartItem(Request $request)
  {
    $old_cart = Cart::where('id', $request->id)->first();
    $price = $old_cart->price / $old_cart->quantity;

    Cart::where('id', $request->id)->update([
      'quantity' => $request->quantity,
      'price' => $request->quantity * $price,
    ]);
    return redirect()->route('addtocart')->with('message', 'Your item updated to cart successfully!');
  }
  public function removeCartItem($id)
  {
    Cart::findOrFail($id)->delete();
    return redirect()->route('addtocart')->with('message', 'Your item removed from cart successfully!');
  }
  public function shippingAddress()
  {
    $shippings = ShippingInfo::where('user_id', Auth::id())->get();
    return view('user.shippingaddress', compact('shippings'));
  }
  public function chooseShippingAddress($id)
  {
    $user_id = Auth::id();
    $cart_items = Cart::where('user_id', $user_id)->get();
    $shipping_address = ShippingInfo::where('id', $id)->first();
    return view('user.checkout', compact('cart_items', 'shipping_address'));
  }
  public function addShippingAddress(Request $request)
  {
    ShippingInfo::insert([
      'user_id' => Auth::id(),
      'phone_number' => $request->phone_number,
      'city_name' => $request->city_name,
      'postal_code' => $request->postal_code,
    ]);
    $user_id = Auth::id();
    $cart_items = Cart::where('user_id', $user_id)->get();
    $shipping_address = ShippingInfo::where('user_id', $user_id)->orderBy('id', 'desc')->first();
    return view('user.checkout', compact('cart_items', 'shipping_address'));
  }
  public function removeShippingAddress($id)
  {
    ShippingInfo::findOrFail($id)->delete();
    $shippings = ShippingInfo::where('user_id', Auth::id())->get();
    return redirect()->route('shippingaddress');
  }
  public function checkout()
  {
    $user_id = Auth::id();
    $cart_items = Cart::where('user_id', $user_id)->get();
    $shipping_address = ShippingInfo::where('user_id', $user_id)->first();
    return view('user.checkout', compact('cart_items', 'shipping_address'));
  }
  public function placeOrder(Request $request)
  {
    $user_id = Auth::id();
    $shipping_address  = ShippingInfo::where('user_id', $user_id)->first();
    $cart_items = Cart::where('user_id', $user_id)->get();

    foreach ($cart_items as $item) {
      Order::insert([
        'user_id' => $user_id,
        'shipping_phone_number' => $shipping_address->phone_number,
        'shipping_city' => $shipping_address->city_name,
        'shipping_postal_code' => $shipping_address->postal_code,
        'product_id' => $item->product_id,
        'quantity' => $item->quantity,
        'total_price' => $item->price,
      ]);

      $id = $item->id;
      Cart::findOrFail($id)->delete();
    }

    return redirect()->route('pendingorders')->with('message', 'Your Order Has Been Placed Successfully!');
  }
  public function userProfile()
  {
    return view('user.userprofile');
  }
  public function pendingOrders()
  {
    $user_id = Auth::id();
    $pending_orders = Order::where(['user_id' => $user_id, 'status' => 'pending'])->latest()->get();
    return view('user.pendingorders', compact('pending_orders'));
  }
  public function history()
  {
    return view('user.history');
  }
  public function newRelease()
  {
    return view('user.newrelease');
  }
  public function todaysDeal()
  {
    return view('user.todaysdeal');
  }
  public function customerService()
  {
    return view('user.customerservice');
  }
}
