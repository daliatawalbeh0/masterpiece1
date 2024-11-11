<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TheUsersController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserDonationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth.custom');


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);


Route::post('/register', [RegisterController::class, 'register'])->name(name: 'register');

use App\Http\Controllers\ExchangeController;

Route::get('/postad', [ExchangeController::class, 'create'])->name('postad');

use App\Models\Subcategory;

Route::get('/get-subcategories/{categoryId}', function ($categoryId) {
    $subcategories = Subcategory::where('category_id', $categoryId)->pluck('name', 'id');
    return response()->json($subcategories);
});
Route::post('/postad', [ExchangeController::class, 'store'])->name('productSuggestions');

Route::get('home', action: [ExchangeController::class, 'index'])->name('home');
Route::get('/itemdetails/{id}', [ItemController::class, 'show'])->name('itemdetails');
Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::get('/subcategory/{id}', [SubcategoryController::class, 'showSubcategoryItems'])->name('category.subcategory');
Route::get('/subcategory/{id}/items', [SubcategoryController::class, 'showSubcategoryItems'])->name('subcategory.items');

Route::post('/send-message', [MessageController::class, 'sendMessage']);
Route::get('/chat/{user_id}', [MessageController::class, 'showChat'])->name('chat');
Route::post('/messages/{user_id}', [MessageController::class, 'sendMessage'])->name('messages.send');

Route::get('/category/show', [CategoryController::class, 'showCategory'])->name('category.show');


Route::resource('userdashboard', AdController::class);
// Route::get('items/{id}', [ItemController::class, 'show'])->name('items.show');
Route::resource('items', ItemController::class);
Route::get('itemdetails/{id}', [ItemController::class, 'showItemDetails'])->name('itemdetails');

Route::get('/userdashboard', [AdController::class, 'index'])->name('userdashboard');
// Display the search form
Route::get('/search', [CategoryController::class, 'searchForm'])->name('searchForm');

// Handle the search functionality
Route::get('/search-results', [CategoryController::class, 'search'])->name('search');
Route::get('/category/search', [CategoryController::class, 'search'])->name('category.search');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/calculate-discount', [ExchangeController::class, 'calculateDiscount'])->name('calculateDiscount');
// Route::post('/productSuggestions', [ItemController::class, 'showProductSuggestions'])->name('productSuggestions');
Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
// Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
// Route::get('/notifications/markAsRead', function () {
//     Auth::user()->unreadNotifications->markAsRead();
//     return back();
// })->name('notifications.markAsRead');


Route::get('/notifications/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/messages/markAsRead', 'NotificationController@markMessagesAsRead')->name('messages.markAsRead');
// Route::post('/deal/confirm', [DealController::class, 'confirmDeal'])->name('deal.confirm');


// Route::post('/deal/confirm/{otherUser}', [DealController::class, 'confirmDeal'])->name('deal.confirm');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');


Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');


Route::post('/logout', function () {
    Auth::logout(); // تسجيل خروج المستخدم
    return redirect('/login'); // إعادة التوجيه إلى صفحة تسجيل الدخول
})->name('logout');
Route::put('/user/{id}', [TheUsersController::class, 'update'])->name('user.update');
Route::get('/userprofilesetting/{id}', [TheUsersController::class, 'edit'])->name('userprofilesetting');



// Route::get('/admindashboard', [AdminController::class, 'index'])->name('admindashboard');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/admindashboard', [AdminController::class, 'index'])->middleware('role:1');
// Route::get('/home', [ExchangeController::class, 'index'])->middleware('role:2');
// Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('role:1');
// // 1 للدور الإداري
// Route::get('/home', [ExchangeController::class, 'index'])->middleware('role:2');
// Route::get('/admindashboard/userstable', [AdminController::class, 'showDataTables'])->name('admindashboard.userstable');
// routes/web.php


Route::prefix('admindashboard')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admindashboard.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admindashboard.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admindashboard.users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('admindashboard.users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admindashboard.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admindashboard.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admindashboard.users.destroy');
});
Route::get('/items/approved', [DonationController::class, 'approvedItems'])->name('items.approved');
Route::get('/items/rejected', [DonationController::class, 'rejectedItems'])->name('items.rejected');
Route::prefix('admindashboard')->group(function () {
    Route::get('/items/pending_donations', [DonationController::class, 'pendingDonations'])->name('admindashboard.items.pending_donations');
    Route::post('/items/{id}/approve', [DonationController::class, 'approveDonation'])->name('admindashboard.items.approve_donation');
    Route::post('/items/{id}/reject', [DonationController::class, 'rejectDonation'])->name('admindashboard.items.reject_donation');
});
Route::get('/items/{id}/show', [DonationController::class, 'showitems'])->name('admindashboard.items.show');

Route::prefix('admindashboard')->group(function () {
    Route::get('/items/pending_exchanges', [ItemController::class, 'pendingExchanges'])->name('admindashboard.items.pending_exchanges');
    Route::post('/items/{id}/approveExchange', [ItemController::class, 'approveExchange'])->name('admindashboard.items.approve_exchange');
    Route::post('/items/{id}/rejectExchange', [ItemController::class, 'rejectExchange'])->name('admindashboard.items.reject_exchange');
});
Route::get('/admindashboard/items/approved_donations', [DonationController::class, 'ShowapprovedDonations'])->name('admindashboard.items.approved_donations');
// Route::prefix('admindashboard/approved_donation')->group(function () {
//     Route::get('/', [DonationController::class, 'index'])->name('admindashboard.approved_donation.index');
//     Route::get('/create', [DonationController::class, 'create'])->name('admindashboard.approved_donation.create');
//     Route::post('/', [DonationController::class, 'store'])->name('admindashboard.approved_donation.store');
//     Route::get('/{id}/edit', [DonationController::class, 'edit'])->name('admindashboard.approved_donation.edit');
//     Route::put('/{id}', [DonationController::class, 'update'])->name('admindashboard.approved_donation.update');
//     Route::get('/{id}', [DonationController::class, 'show'])->name('admindashboard.approved_donation.show');
// });
// Route::get('admindashboard/items/approved_donation', [DonationController::class, 'index'])->name('admindashboard.items.approved_donations');

Route::get('admindashboard/approved_donation/create', [DonationController::class, 'create'])->name('admindashboard.approved_donations.create');

Route::post('admindashboard/approved_donation/store', [DonationController::class, 'store'])->name('admindashboard.approved_donations.store');

// // عرض صفحة تعديل التبرع
// Route::get('admindashboard/approved_donation/{id}/edit', [DonationController::class, 'edit'])->name('admindashboard.approved_donations.edit');

// // تحديث بيانات التبرع

// // عرض تفاصيل التبرع
// Route::get('admindashboard/approved_donation/{id}', [DonationController::class, 'show'])->name('admindashboard.approved_donations.show');

Route::delete('admindashboard/approved_donation/{id}', [DonationController::class, 'destroy'])->name('admindashboard.approved_donations.destroy');
// Route::get('admindashboard/approved_donation/{id}', [DonationController::class, 'show'])->name('admindashboard.approved_donations.show');
Route::get('/admindashboard/items/approved_donations/{id}', [DonationController::class, 'show'])->name('admindashboard.items.approved_donations.show');
Route::get('/admindashboard/items/approved_donations/{id}/edit', [DonationController::class, 'edit'])->name('admindashboard.items.approved_donations.edit');
Route::delete('/admindashboard/items/approved_donations/{id}/delete', [DonationController::class, 'destroy'])->name('admindashboard.items.approved_donations.destroy');
Route::put('admindashboard/approved_donations/{id}', [DonationController::class, 'update'])->name('admindashboard.approved_donations.update');
Route::get('admindashboard/exchanges/pending', [ExchangeController::class, 'pendingExchanges'])->name('admindashboard.exchanges.pending');
Route::post('admindashboard/exchanges/{id}/approve', [ExchangeController::class, 'approveExchange'])->name('admindashboard.exchanges.approve');
Route::post('admindashboard/exchanges/{id}/reject', [ExchangeController::class, 'rejectExchange'])->name('admindashboard.exchanges.reject');
Route::get('admindashboard/items/approved_exchanges', [ExchangeController::class, 'approvedExchangesads'])->name('admindashboard.items.approved_exchanges');
Route::get('admindashboard/exchanges/approved_deals', [ExchangeController::class, 'approvedDealExchanges'])->name('admindashboard.exchanges.approved_deals');
Route::get('admindashboard/exchanges/rejected_deals', [ExchangeController::class, 'rejectedDealExchanges'])->name('admindashboard.exchanges.rejected_deals');
// Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admindashboard.profile.show');



Route::get('/create-donation', function () {
    return view('create_donation');
})->name('create_donation');

Route::get('/user/create-donation', [UserDonationController::class, 'create'])->name('user.create_donation');

Route::post('/user/store-donation', [UserDonationController::class, 'store'])->name('user.store_donation');
// Route::get('/category', action: [CategoryController::class, 'index'])->name('category');


Route::get('/categories/display', [CategoryController::class, 'displayCategories'])->name('categories.display');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::match(['get', 'post'], '/productSuggestions', [ItemController::class, 'showProductSuggestions'])->name('productSuggestions');
Route::post('/productSuggestions', [ItemController::class, 'showProductSuggestions'])->name('productSuggestions');
// Route::post('/deal/confirm/{id}', [DealController::class, 'confirmDeal'])->name('deal.confirm');
Route::post('/deal/confirm/{user_id}', [MessageController::class, 'confirmDeal'])->name('deal.confirm');





Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admindashboard.index');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admindashboard.index');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// routes/web.php
Route::get('/confirm-deal/{otherUserItemId}', [ExchangeController::class, 'confirmForm'])->name('deal.confirmForm');
Route::post('/store-deal', [ExchangeController::class, 'storeDeal'])->name('deal.store');
Route::get('/deal/confirm', function () {
    return view('deal');
});
Route::get('/confirm-deal/{otherUserItemId}', [ExchangeController::class, 'confirmForm'])->name('deal.confirm');
