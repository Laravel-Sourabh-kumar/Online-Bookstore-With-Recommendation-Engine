<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookshopHomeController;
use App\Http\Controllers\Admin\AdminBooksController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminAuthorsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminReviewsController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function () {
          return redirect('/');
     });
//Route::get('/', [App\Http\Controllers\BookshopHomeController::class,'index'])->name('bookshop.home');
Route::get('/', [App\Http\Controllers\BookshopHomeController::class,'index'])->name('bookshop.home');

Route::get('/all-books', [App\Http\Controllers\BookshopHomeController::class,'allBooks'])->name('all-books');
Route::get('/discount-books', [App\Http\Controllers\BookshopHomeController::class,'discountBooks'])->name('discount-books');
Route::get('/category/{category}', [App\Http\Controllers\BookshopHomeController::class,'category'])->name('category');
Route::get('/author/{author}', [App\Http\Controllers\BookshopHomeController::class,'author'])->name('author');

Route::get('/book/{book}', [App\Http\Controllers\BookshopHomeController::class,'bookDetails'])->name('book-details');

Route::post('/book/{book}/review', [App\Http\Controllers\ReviewsController::class,'store'])->name('book.review');

// Cart Route
Route::post('/cart/add', [App\Http\Controllers\ShoppingCartController::class,'add_to_cart'])->name('cart.add');
Route::get('/cart/page', [App\Http\Controllers\ShoppingCartController::class,'cart'])->name('cart');
Route::get('/cart/delete/{id}', [App\Http\Controllers\ShoppingCartController::class,'cart_delete'])->name('cart.delete');
Route::get('/cart/increment/{id}/{qty}/{book_id}', [App\Http\Controllers\ShoppingCartController::class,'cart_increment'])->name('cart.increment');
Route::get('/cart/decrement/{id}/{qty}', [App\Http\Controllers\ShoppingCartController::class,'cart_decrement'])->name('cart.decrement');

Route::get('/cart/checkout', [App\Http\Controllers\CheckoutController::class,'index'])->name('cart.checkout');
Route::post('/cart/proceed', [App\Http\Controllers\CheckoutController::class,'store'])->name('cart.proceed');
Route::get('/cart/payment', [App\Http\Controllers\CheckoutController::class,'show'])->name('cart.payment');
Route::post('/cart/checkout', [App\Http\Controllers\CheckoutController::class,'pay'])->name('cart.checkout');
// End of cart route

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/admin-home', [App\Http\Controllers\Admin\AdminBaseController::class,'index'])->name('admin.home');

// Admin Route group
Route::group(['middleware' => 'admin'], function (){
    Route::get('/admin-home', [App\Http\Controllers\Admin\AdminBaseController::class,'index'])->name('admin.home');

    Route::put('/admin/books/restore/{id}', [App\Http\Controllers\Admin\AdminBooksController::class,'restore'])->name('book.restore');
    Route::delete('admin/books/forceDelete/{id}', [App\Http\Controllers\Admin\AdminBooksController::class,'forceDelete'])->name('book.forceDelete');
    Route::get('/trash-books', [App\Http\Controllers\Admin\AdminBooksController::class,'trashBooks'])->name('admin.trash-books');
    Route::get('admin/discount-books', [App\Http\Controllers\Admin\AdminBooksController::class,'discountBooks'])->name('admin.discountBooks');

    Route::resource('/admin/books',AdminBooksController::class);
    Route::resource('/admin/categories',AdminCategoriesController::class);
    Route::resource('/admin/authors',AdminAuthorsController::class);
    Route::resource('/admin/users',AdminUsersController::class);
    Route::resource('/admin/orders',AdminOrdersController::class);
    Route::resource('/admin/reviews',AdminReviewsController::class);
});
// End of admin route

// Users route group
Route::group(['middleware' => 'user'], function (){
    Route::get('/user-home', [App\Http\Controllers\Users\UsersBaseController::class,'index'])->name('user.home');
    Route::get('/my-orders', [App\Http\Controllers\Users\UserOrdersController::class,'myOrders'])->name('user.orders');
    Route::get('/order/details/{id}', [App\Http\Controllers\Users\UserOrdersController::class,'order_details'])->name('order.details');

    Route::get('/my-reviews', [App\Http\Controllers\Users\UserReviewsController::class,'myReviews'])->name('user.reviews');
    Route::delete('/review-delete/{id}', [App\Http\Controllers\Users\UserReviewsController::class,'deleteReview'])->name('review.delete');
});
// End of users route

Route::get('/logout', [App\Http\Controllers\CustomLogoutController::class,'logout'])->name('logout');