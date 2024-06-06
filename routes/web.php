<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\ShippingChargeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\PartnerController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController as ProductFront;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get("/login",[AuthController::class,'login_admin'])->name("login");
Route::post("/login",[AuthController::class,'auth_login_admin'])->name("admin_login");
Route::get("/logout",[AuthController::class,'logout_admin'])->name("logout");

Route::group(['middleware'=>'user'],function(){
    Route::get("/user/dashboard",[UserController::class,'Dashboard'])->name("user.dashboard");
    Route::get("/user/orders",[UserController::class,'Orders'])->name("user.orders");
    Route::get("/user/orders/{id}",[UserController::class,'OrderDetail'])->name("user.order.detail");

    Route::get("/user/edit-profile",[UserController::class,'EditProfile'])->name("user.edit_profile");
    Route::post("/user/edit-profile",[UserController::class,'UpdateProfile'])->name("user.update_profile");
    Route::get("/user/change-password",[UserController::class,'ChangePassword'])->name("user.change_password");
    Route::post("/user/change-password",[UserController::class,'UpdatePassword'])->name("user.update_password");

    Route::post("/add_to_wishlist",[UserController::class,'AddToWishlist'])->name('add_to_wishlist');

    Route::get("/my-wishlist",[ProductFront::class,'WishList'])->name('my_wishlist');
    Route::post("/user/make-reivew",[UserController::class,'submit_review'])->name("user.make-reivew");
});
Route::group(['middleware'=>'admin'],function(){
    Route::get("admin/dashboard",[DashboardController::class,'dashboard'])->name("admin.dashboard");

    //admin
    Route::get("/admin/admin/list",[AdminController::class,'ListAdmin'])->name("admin.admin.list");
    Route::get("/admin/admin/add",[AdminController::class,'AddAdmin'])->name("admin.admin.add");
    Route::post("/admin/admin/add",[AdminController::class,'InsertAdmin'])->name("admin.admin.insert");
    Route::get("/admin/admin/edit/{id}",[AdminController::class,'EditAdmin'])->name("admin.admin.edit");
    Route::post("/admin/admin/edit/{id}",[AdminController::class,'UpdateAdmin'])->name("admin.admin.update");
    Route::get("/admin/admin/remove/{id}",[AdminController::class,'RemoveAdmin'])->name("admin.admin.remove");

    //category
    Route::get("/admin/category/list",[CategoryController::class,'ListCategories'])->name("admin.categories.list");
    Route::get("/admin/category/add",[CategoryController::class,'AddCategory'])->name("admin.category.add");
    Route::post("/admin/category/add",[CategoryController::class,'InsertCategory'])->name("admin.category.insert");
    Route::get("/admin/category/edit/{id}",[CategoryController::class,'EditCategory'])->name("admin.category.edit");
    Route::post("/admin/category/edit/{id}",[CategoryController::class,'UpdateCategory'])->name("admin.category.update");
    Route::get("/admin/category/remove/{id}",[CategoryController::class,'RemoveCategory'])->name("admin.category.remove");

    Route::get("/admin/sub_category/list",[SubCategoryController::class,'List'])->name("admin.sub_categories.list");
    Route::get("/admin/sub_category/add",[SubCategoryController::class,'Add'])->name("admin.sub_category.add");
    Route::post("/admin/sub_category/add",[SubCategoryController::class,'Insert'])->name("admin.sub_category.insert");
    Route::get("/admin/sub_category/edit/{id}",[SubCategoryController::class,'Edit'])->name("admin.sub_category.edit");
    Route::post("/admin/sub_category/edit/{id}",[SubCategoryController::class,'Update'])->name("admin.sub_category.update");
    Route::get("/admin/sub_category/remove/{id}",[SubCategoryController::class,'Remove'])->name("admin.sub_category.remove");

    Route::post('/admin/get_sub_category',[SubCategoryController::class,'Get_Sub_Category'])->name('admin.get_sub_category');

    //product
    Route::get("/admin/product/list",[ProductController::class,'List'])->name("admin.product.list");
    Route::get("/admin/product/add",[ProductController::class,'Add'])->name("admin.product.add");
    Route::post("/admin/product/add",[ProductController::class,'Insert'])->name("admin.product.insert");
    Route::get("/admin/product/edit/{id}",[ProductController::class,'Edit'])->name("admin.product.edit");
    Route::post("/admin/product/edit/{id}",[ProductController::class,'Update'])->name("admin.product.update");
    Route::get("/admin/product/remove/{id}",[ProductController::class,'Remove'])->name("admin.product.remove");
    Route::get("/admin/product/delete_image/{id}",[ProductController::class,'DeleteImage'])->name("admin.product.delele.image");
    Route::post("/admin/product/image/sortable",[ProductController::class,'Sortable'])->name("admin.product.image.sortable");

    //brand
    Route::get("/admin/brand/list",[BrandController::class,'List'])->name("admin.brand.list");
    Route::get("/admin/brand/add",[BrandController::class,'Add'])->name("admin.brand.add");
    Route::post("/admin/brand/add",[BrandController::class,'Insert'])->name("admin.brand.insert");
    Route::get("/admin/brand/edit/{id}",[BrandController::class,'Edit'])->name("admin.brand.edit");
    Route::post("/admin/brand/edit/{id}",[BrandController::class,'Update'])->name("admin.brand.update");
    Route::get("/admin/brand/remove/{id}",[BrandController::class,'Remove'])->name("admin.brand.remove");

    //color
    Route::get("/admin/color/list",[ColorController::class,'List'])->name("admin.color.list");
    Route::get("/admin/color/add",[ColorController::class,'Add'])->name("admin.color.add");
    Route::post("/admin/color/add",[ColorController::class,'Insert'])->name("admin.color.insert");
    Route::get("/admin/color/edit/{id}",[ColorController::class,'Edit'])->name("admin.color.edit");
    Route::post("/admin/color/edit/{id}",[ColorController::class,'Update'])->name("admin.color.update");
    Route::get("/admin/color/remove/{id}",[ColorController::class,'Remove'])->name("admin.color.remove");

     //discount code
     Route::get("/admin/discount-code/list",[DiscountCodeController::class,'List'])->name("admin.discount_code.list");
     Route::get("/admin/discount-code/add",[DiscountCodeController::class,'Add'])->name("admin.discount_code.add");
     Route::post("/admin/discount-code/add",[DiscountCodeController::class,'Insert'])->name("admin.discount_code.insert");
     Route::get("/admin/discount-code/edit/{id}",[DiscountCodeController::class,'Edit'])->name("admin.discount_code.edit");
     Route::post("/admin/discount-code/edit/{id}",[DiscountCodeController::class,'Update'])->name("admin.discount_code.update");
     Route::get("/admin/discount-code/remove/{id}",[DiscountCodeController::class,'Remove'])->name("admin.discount_code.remove");

     Route::get("/admin/shipping_charge/list",[ShippingChargeController::class,'List'])->name("admin.shipping_charge.list");
     Route::get("/admin/shipping_charge/add",[ShippingChargeController::class,'Add'])->name("admin.shipping_charge.add");
     Route::post("/admin/shipping_charge/add",[ShippingChargeController::class,'Insert'])->name("admin.shipping_charge.insert");
     Route::get("/admin/shipping_charge/edit/{id}",[ShippingChargeController::class,'Edit'])->name("admin.shipping_charge.edit");
     Route::post("/admin/shipping_charge/edit/{id}",[ShippingChargeController::class,'Update'])->name("admin.shipping_charge.update");
     Route::get("/admin/shipping_charge/remove/{id}",[ShippingChargeController::class,'Remove'])->name("admin.shipping_charge.remove");

     Route::get("/admin/orders/list",[OrdersController::class,'List'])->name("admin.orders.list");
     Route::get("/admin/orders/detail/{id}",[OrdersController::class,'Detail'])->name("admin.orders.detail");
     Route::get("/admin/order_status",[OrdersController::class,'OrderStatus'])->name('admin.order_status');

     Route::get("/admin/customer/list",[AdminController::class,'ListCustomer'])->name("admin.customer.list");

     Route::get("/admin/page/list",[PageController::class,'List'])->name("admin.page.list");
     Route::get("/admin/page/edit/{id}",[PageController::class,'Edit'])->name("admin.page.edit");
     Route::post("/admin/page/edit/{id}",[PageController::class,'Update'])->name("admin.page.update");

     Route::get("/admin/system-setting",[PageController::class,'SystemSetting'])->name("admin.system_setting");
     Route::post("/admin/system-setting",[PageController::class,'UpdateSetting']);

     Route::get("/admin/contact-us/list",[PageController::class,'ContactUs'])->name('admin.contact_us.list');
     Route::get("/admin/contact-us/delete/{id}",[PageController::class,'DeleteContactUs'])->name('admin.contact_us.delete');

     Route::get("/admin/slider/list",[SliderController::class,'List'])->name("admin.slider.list");
     Route::get("/admin/slider/add",[SliderController::class,'Add'])->name("admin.slider.add");
     Route::post("/admin/slider/add",[SliderController::class,'Insert'])->name("admin.slider.insert");
     Route::get("/admin/slider/edit/{id}",[SliderController::class,'Edit'])->name("admin.slider.edit");
     Route::post("/admin/slider/edit/{id}",[SliderController::class,'Update'])->name("admin.slider.update");
     Route::get("/admin/slider/remove/{id}",[SliderController::class,'Remove'])->name("admin.slider.remove");

     Route::get("/admin/partner/list",[PartnerController::class,'List'])->name("admin.partner.list");
     Route::get("/admin/partner/add",[PartnerController::class,'Add'])->name("admin.partner.add");
     Route::post("/admin/partner/add",[PartnerController::class,'Insert'])->name("admin.partner.insert");
     Route::get("/admin/partner/edit/{id}",[PartnerController::class,'Edit'])->name("admin.partner.edit");
     Route::post("/admin/partner/edit/{id}",[PartnerController::class,'Update'])->name("admin.partner.update");
     Route::get("/admin/partner/remove/{id}",[PartnerController::class,'Remove'])->name("admin.partner.remove");

     Route::get("/admin/blogcategory/list",[BlogCategoryController::class,'List'])->name("admin.blogcategory.list");
     Route::get("/admin/blogcategory/add",[BlogCategoryController::class,'Add'])->name("admin.blogcategory.add");
     Route::post("/admin/blogcategory/add",[BlogCategoryController::class,'Insert'])->name("admin.blogcategory.insert");
     Route::get("/admin/blogcategory/edit/{id}",[BlogCategoryController::class,'Edit'])->name("admin.blogcategory.edit");
     Route::post("/admin/blogcategory/edit/{id}",[BlogCategoryController::class,'Update'])->name("admin.blogcategory.update");
     Route::get("/admin/blogcategory/remove/{id}",[BlogCategoryController::class,'Remove'])->name("admin.blogcategory.remove");

     Route::get("/admin/blog/list",[BlogController::class,'List'])->name("admin.blog.list");
     Route::get("/admin/blog/add",[BlogController::class,'Add'])->name("admin.blog.add");
     Route::post("/admin/blog/add",[BlogController::class,'Insert'])->name("admin.blog.insert");
     Route::get("/admin/blog/edit/{id}",[BlogController::class,'Edit'])->name("admin.blog.edit");
     Route::post("/admin/blog/edit/{id}",[BlogController::class,'Update'])->name("admin.blog.update");
     Route::get("/admin/blog/remove/{id}",[BlogController::class,'Remove'])->name("admin.blog.remove");
});

Route::get('/',[HomeController::class,'home'])->name('home');
Route::post('/recent_arrival_category_product',[HomeController::class,'recent_arrival_category_product']);
Route::post('/trendy_product_category',[HomeController::class,'trendyCategoryProduct']);

Route::get('/contact',[HomeController::class,'Contact'])->name('contact');
Route::post('/contact',[HomeController::class,'SubmitContact']);
Route::get('/about',[HomeController::class,'About'])->name('about');
Route::get('/faq',[HomeController::class,'Faq'])->name('faq');
Route::get('/payment-methods',[HomeController::class,'PaymentMethods'])->name('payment_methods');
Route::get('/money-back-guarantee',[HomeController::class,'MoneyBackGurantee'])->name('money_back_guarantee');
Route::get('/returns',[HomeController::class,'Returns'])->name('returns');
Route::get('/shipping',[HomeController::class,'Shipping'])->name('shipping');
Route::get('/terms-conditions',[HomeController::class,'TermConditions'])->name('terms-conditions');
Route::get('/privacy-policy',[HomeController::class,'PrivacyPolicy'])->name('privacy-policy');
Route::get('blog',[HomeController::class,'Blog'])->name('blog');
Route::post('/auth_register',[AuthController::class,'AuthRegister'])->name("auth_register");
Route::post('/auth_login',[AuthController::class,'AuthLogin'])->name('auth_login');
Route::get("/active/{id}",[AuthController::class,'ActiveEmail'])->name('active_email');

Route::get("/forgot-password",[AuthController::class,'ForgotPassword'])->name('forgot_password');
Route::post("/forgot-password",[AuthController::class,'AuthForgotPassword'])->name('auth_forgot_password');
Route::get('/reset/{token}',[AuthController::class,'ResetPassword'])->name('reset_password');
Route::post('/reset/{token}',[AuthController::class,'AuthResetPassword'])->name('auth_reser_password');

Route::get('search',[ProductFront::class,'GetProductSearch']);

Route::get('cart',[PaymentController::class,'Cart'])->name("cart");
Route::post('product/add-to-cart',[PaymentController::class,'AddToCart'])->name('product.add-to-cart');
Route::get('cart/delete/{id}',[PaymentController::class,'DeleteCart'])->name('cart.delete');
Route::post('cart/update',[PaymentController::class,'UpdateCart'])->name('cart.update');

Route::get('checkout',[PaymentController::class,'CheckOut'])->name('cart.checkout');
Route::post("checkout/apply_discount_code",[PaymentController::class,'ApplyDiscoutCode'])->name("apply_discount_code");
Route::post("checkout/place_order",[PaymentController::class,'PlaceOrder'])->name("place_order");
Route::get('checkout/payment',[PaymentController::class,'CheckOutPayment'])->name('checkout_payemnt');
Route::get('paypal/success-payment',[PaymentController::class,'PaySuccessPayment'])->name('paypal_success_payment');
Route::get('stripe/payment-success',[PaymentController::class,'StripeSuccessPayment']);

Route::post('get_filter_product_ajax',[ProductFront::class,'GetFilterCategoryAjax'])->name('get_filter_product_ajax');
Route::get('{slug?}/{sub_slug?}',[ProductFront::class,'getCategory'])->name('get_category');