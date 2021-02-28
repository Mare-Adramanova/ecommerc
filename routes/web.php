<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/products');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'] )->name('products.index');
Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::get('/shop', [App\Http\Controllers\ProductController::class, 'shop'] )->name('shop');

Route::get('/cart/{product}', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/cart', function () {
    return view('product.cart');
});
Route::post('/switchToCart/{product}', [App\Http\Controllers\CartController::class, 'switchToCart'])->name('switchToCart');
Route::get('/wish_list', function () {
    return view('product.wish_list');
});
Route::get('/saveforlater/{product}', [App\Http\Controllers\WishListController::class, 'store'])->name('saveForLater.store');
Route::delete('/saveforlater/{product}', [App\Http\Controllers\WishListController::class, 'destroy'])->name('saveForLater.delete');



Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkoutPost'])->name('checkout.post')->middleware('auth');

Route::post('/coupon', [App\Http\Controllers\CouponsController::class, 'store'])->name('coupon.store');
Route::delete('/coupon', [App\Http\Controllers\CouponsController::class, 'destroy'])->name('coupon.delete');

Route::get('/review', [App\Http\Controllers\ProductController::class, 'review'])->name('review')->middleware('auth');

Route::post('/search', [App\Http\Controllers\SearchController::class, 'index'] )->name('search.index');
Route::post('/autocomplite', [App\Http\Controllers\SearchController::class, 'autocomplite'] )->name('autocomplite');

Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::put('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'show'])->name('comments.show');

Route::get('/rating/{product}', [App\Http\Controllers\ProductController::class, 'rating'])->name('rating');


Route::get('users/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('user.logout');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login.submit');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
       
    });
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');

    Route::post('password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('admin.password.update');
    Route::get('password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');

    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'] )->name('admin.orders.index');
    Route::get('/orders/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/orders', [App\Http\Controllers\Admin\OrderController::class, 'store'])->name('admin.order.store');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order.show');
    Route::delete('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::get('/orders/{order}/edit', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('admin.order.edit');
    Route::put('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.order.update');

    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'] )->name('admin.products.index');
    Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('admin.product.show');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');

    Route::get('/variations', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'index'] )->name('admin.productVariations.index');
    Route::get('/variations/create', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'create'])->name('admin.productVariations.create');
    Route::post('/variations', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'store'])->name('admin.productVariations.store');
    Route::get('/variations/{variation}', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'show'])->name('admin.productVariations.show');
    Route::delete('/variations/{variation}', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'destroy'])->name('admin.productVariations.destroy');
    Route::get('/variations/{variation}/edit', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'edit'])->name('admin.productVariations.edit');
    Route::put('/variations/{variation}', [App\Http\Controllers\Admin\ColorProductSizeController::class, 'update'])->name('admin.productVariations.update');


    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.category.show');
    Route::delete('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('/categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');

    Route::get('/coupons', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/coupons/create', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/coupons', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupons/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'show'])->name('admin.coupon.show');
    Route::delete('/coupons/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('admin.coupon.destroy');
    Route::get('/coupons/{coupon}/edit', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::put('/coupons/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'update'])->name('admin.coupon.update');

    Route::get('/users', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'index'])->name('admin.users.index');
    Route::get('/users/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'show'])->name('admin.user.show');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/user/orders/{user}', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'orders'])->name('user.orders.show');

    Route::get('/colors', [App\Http\Controllers\Admin\ColorController::class, 'index'])->name('admin.colors.index');
    Route::get('/colors/create', [App\Http\Controllers\Admin\ColorController::class, 'create'])->name('admin.colors.create');
    Route::post('/colors', [App\Http\Controllers\Admin\ColorController::class, 'store'])->name('admin.colors.store');
    Route::get('/colors/{color}', [App\Http\Controllers\Admin\ColorController::class, 'show'])->name('admin.color.show');
    Route::delete('/colors/{color}', [App\Http\Controllers\Admin\ColorController::class, 'destroy'])->name('admin.color.destroy');
    Route::get('/colors/{color}/edit', [App\Http\Controllers\Admin\ColorController::class, 'edit'])->name('admin.color.edit');
    Route::put('/colors/{color}', [App\Http\Controllers\Admin\ColorController::class, 'update'])->name('admin.color.update');

    Route::get('/sizes', [App\Http\Controllers\Admin\SizeController::class, 'index'])->name('admin.sizes.index');
    Route::get('/sizes/create', [App\Http\Controllers\Admin\SizeController::class, 'create'])->name('admin.sizes.create');
    Route::post('/sizes', [App\Http\Controllers\Admin\SizeController::class, 'store'])->name('admin.sizes.store');
    Route::get('/sizes/{size}', [App\Http\Controllers\Admin\SizeController::class, 'show'])->name('admin.size.show');
    Route::delete('/sizes/{size}', [App\Http\Controllers\Admin\SizeController::class, 'destroy'])->name('admin.size.destroy');
    Route::get('/sizes/{size}/edit', [App\Http\Controllers\Admin\SizeController::class, 'edit'])->name('admin.size.edit');
    Route::put('/sizes/{size}', [App\Http\Controllers\Admin\SizeController::class, 'update'])->name('admin.size.update');

    

});

Route::get('/sizes/get_by_color', [App\Http\Controllers\Admin\SizeController::class, 'get_by_color'])->name('get_by_color');

Route::put('/my-profile', [App\Http\Controllers\UseresController::class, 'update'])->name('users.update');
Route::get('my-orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
