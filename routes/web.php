<?php

use Illuminate\Support\Facades\Route;

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
//
//Route::get('/', function () {
//    return view('/layouts/HomeView');
//});
Route::get('/',\App\Http\Livewire\HomeComponent::class);

Route::get('/shop',\App\Http\Livewire\ShopComponent::class);
Route::get('/cart',\App\Http\Livewire\CartComponent::class)->name('product.cart');
Route::get('/checkout',\App\Http\Livewire\CheckoutComponent::class);
Route::get('/products/{slug}',\App\Http\Livewire\DetailsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}',\App\Http\Livewire\CategoryComponent::class)->name('product.category');
Route::get('/contact-us',\App\Http\Livewire\ContactComponent::class)->name('contact');
Route::get('/about-us',\App\Http\Livewire\AboutUsComponent::class)->name('about');




Route::get('/sentEmail',\App\Http\Livewire\SentEmailComponent::class)->name('sentEmail');

Route::get('/search',\App\Http\Livewire\SearchComponent::class)->name('product.search');
Route::get('/wishlist',\App\Http\Livewire\WishlistComponent::class)->name('product.wishlist');
Route::get('/checkout',\App\Http\Livewire\CheckoutComponent::class)->name('checkout');
Route::get('/thankYou',\App\Http\Livewire\ThankYouComponent::class)->name('thankYou');
Route::get('/isBlocked',\App\Http\Livewire\UserIsblocked::class)->name('blocked');



//For User / Customer
Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get('/user/orders',\App\Http\Livewire\User\UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}',\App\Http\Livewire\User\UserOrderDetailsComponent::class)->name('user.orderDetail');
    Route::get('/user/review/{order_item_id}',\App\Http\Livewire\User\UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password',\App\Http\Livewire\User\UserChangePasswordComponent::class)->name('user.changePassword');
    Route::get('/user/profile',\App\Http\Livewire\UserProfileSettingComponent::class)->name('user.profile');

});

//For Admin
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function (){

    Route::get('admin/Headers',\App\Http\Livewire\HeadersSettingComponent::class)->name('admin.headers');
    Route::get('admin/headers/add',\App\Http\Livewire\AddHeaderComponent::class)->name('admin.addHeader');
    Route::get('admin/headers/edit/{header_id}',\App\Http\Livewire\EditHeaderComponent::class)->name('admin.editHeader');

    Route::get('admin/categories',\App\Http\Livewire\Admin\AdminCategoryComponent::class)->name('admin.categories');
    Route::get('admin/category/add',\App\Http\Livewire\Admin\AdminAddCategoryComponent::class)->name('admin.addCategory');
    Route::get('admin/category/edit/{category_slug}',\App\Http\Livewire\Admin\AdminEditCategoryComponent::class)->name('admin.editCategory');

    Route::get('admin/products',\App\Http\Livewire\Admin\AdminProductComponent::class)->name('admin.products');
    Route::get('admin/products/add',\App\Http\Livewire\Admin\AdminAddProductComponent::class)->name('admin.addProducts');
    Route::get('admin/products/edit/{product_slug}',\App\Http\Livewire\Admin\AdminEditProductComponent::class)->name('admin.editProducts');

    Route::get('admin/slider',\App\Http\Livewire\Admin\AdminHomeSliderComponent::class)->name('admin.homeSlider');
    Route::get('admin/slider/add',\App\Http\Livewire\Admin\AdminAddHomeSliderComponent::class)->name('admin.addHomeSlider');
    Route::get('admin/slider/edit/{slide_id}',\App\Http\Livewire\Admin\AdminEditHomeSliderComponent::class)->name('admin.editHomeSlider');

    Route::get('admin/home-categories',\App\Http\Livewire\Admin\AdminHomeCategoryComponent::class)->name('admin.homeCategories');

    Route::get('admin/sale',\App\Http\Livewire\Admin\AdminSaleComponent::class)->name('admin.sale');


    Route::get('admin/orders',\App\Http\Livewire\Admin\AdminOrderComponent::class)->name('admin.orders');
    Route::get('admin/orders/{order_id}',\App\Http\Livewire\Admin\AdminOrderDetailsComponent::class)->name('admin.orderDetail');
    Route::get('/admin/contact-us',\App\Http\Livewire\AdminContactComponent::class)->name('admin.contact');

    Route::get('/admin/about-us',\App\Http\Livewire\AdminAboutUsComponent::class)->name('admin.about');

    Route::get('/admin/team',\App\Http\Livewire\AdminTeamComponent::class)->name('admin.team');
    Route::get('/admin/team/add',\App\Http\Livewire\AdminAddTeamComponent::class)->name('admin.addTeam');
    Route::get('/admin/team/edit/{team_id}',\App\Http\Livewire\AdminEditTeamComponent::class)->name('admin.editTeam');

    Route::get('/admin/users',\App\Http\Livewire\AdminManageUsersComponent::class)->name('admin.users');
    Route::get('/admin/chart',\App\Http\Livewire\AdminChartsComponent::class)->name('admin.charts');

    Route::get('/admin/change-password',\App\Http\Livewire\User\UserChangePasswordComponent::class)->name('admin.changePassword');
    Route::get('/admin/profile',\App\Http\Livewire\UserProfileSettingComponent::class)->name('admin.profile');





});
