<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\{
  DashboardController,
  UserController,
  CategoryController,
  SubCategoryController,
  OrderController,
  ProductController
};
use App\Http\Controllers\{HomeController, ClientController};
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
  Route::get('', 'index')->name('home');
});


Route::controller(ClientController::class)->group(function () {
  Route::get('/category/{id}/{slug}', 'categoryPage')->name('category');
  Route::get('/product-details/{id}/{slug}', 'singleProduct')->name('singleproduct');
  Route::get('/new-release', 'newRelease')->name('newrelease');
});

Route::middleware(['auth', 'role:user'])->group(function () {
  Route::controller(ClientController::class)->group(function () {
    Route::get('/add-to-cart', 'addToCart')->name('addtocart');
    Route::post('/add-product-to-cart', 'addProductToCart')->name('addproducttocart');

    Route::get('/edit-cart-item/{id}', 'editCartItem')->name('editcartitem');
    Route::post('/update-cart-item', 'updateCartItem')->name('updatecartitem');

    Route::get('/shipping-address', 'shippingAddress')->name('shippingaddress');
    Route::post('/add-shipping-address', 'addShippingAddress')->name('addshippingaddress');
    Route::get('/choose-shipping-address/{id}', 'chooseShippingAddress')->name('chooseshippingaddress');
    Route::get('/remove-shipping-address/{id}', 'removeShippingAddress')->name('removeshippingaddress');

    Route::post('/place-order', 'placeOrder')->name('placeorder');
    Route::get('/checkout', 'checkout')->name('checkout');

    Route::get('/user-profile', 'userProfile')->name('userprofile');
    Route::get('/user-profile/pending-orders', 'pendingOrders')->name('pendingorders');
    Route::get('/user-profile/history', 'history')->name('history');

    Route::get('todays-deal', 'todaysDeal')->name('todaysdeal');
    Route::get('customer-service', 'customerService')->name('customerservice');
    Route::get('/remove-cart-item/{id}', 'removeCartItem')->name('removecartitem');
  });
});

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::controller(DashboardController::class)->group(function () {
    Route::get('/admin/dashboard', 'index')->name('admindashboard');
    Route::get('/admin/bar-chart-data', 'barChartData')->name('barchartdata');
  });

  Route::controller(UserController::class)->group(function () {
    Route::get('/admin/user', 'index')->name('alluser');

    Route::get('/admin/edit-user/{id}', 'editUser')->name('edituser');
    Route::post('/admin/update-user', 'updateUser')->name('updateuser');

    Route::get('/admin/delete-user/{id}', 'deleteUser')->name('deleteuser');
  });
  Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/category', 'index')->name('allcategory');

    Route::get('/admin/add-category', 'addCategory')->name('addcategory');
    Route::post('/admin/store-category', 'storeCategory')->name('storecategory');

    Route::get('/admin/edit-category/{id}', 'editCategory')->name('editcategory');
    Route::post('/admin/update-category', 'updateCategory')->name('updatecategory');

    Route::get('/admin/delete-category/{id}', 'deleteCategory')->name('deletecategory');
  });

  Route::controller(SubCategoryController::class)->group(function () {
    Route::get('/admin/subcategory', 'index')->name('allsubcategory');

    Route::get('/admin/add-subcategory', 'addSubCategory')->name('addsubcategory');
    Route::post('/admin/store-subcategory', 'storeSubCategory')->name('storesubcategory');

    Route::get('/admin/edit-subcategory/{id}', 'editSubCat')->name('editsubcat');
    Route::post('/admin/update-subcategory', 'updateSubCat')->name('updatesubcat');

    Route::get('/admin/delete-subcategory/{id}', 'deleteSubCat')->name('deletesubcat');
  });

  Route::controller(ProductController::class)->group(function () {
    Route::get('/admin/product', 'index')->name('allproduct');

    Route::get('/admin/add-product', 'addProduct')->name('addproduct');
    Route::post('/admin/store-product', 'storeProduct')->name('storeproduct');

    Route::get('/admin/edit-product-img/{id}', 'editProductImg')->name('editproductimg');
    Route::post('/admin/update-product-img', 'updateProductImg')->name('updateproductimg');

    Route::get('/admin/edit-product/{id}', 'editProduct')->name('editproduct');
    Route::post('/admin/update-product', 'updateProduct')->name('updateproduct');

    Route::get('/admin/delete-product/{id}', 'deleteProduct')->name('deleteproduct');
  });

  Route::controller(OrderController::class)->group(function () {
    Route::get('/admin/pending-order', 'index')->name('pendingorder');
    Route::get('/admin/get-approve-order', 'getApproveOrder')->name('getapproveorder');
    Route::get('/admin/approve-order/{id}', 'approveOrder')->name('approveorder');
    Route::get('/admin/get-reject-order', 'getRejectOrder')->name('getrejectorder');
    Route::get('/admin/reject-order/{id}', 'rejectOrder')->name('rejectorder');
  });
});

require __DIR__ . '/auth.php';
