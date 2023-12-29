
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


//TODO: Reset Route

Auth::routes();

// Xóa bộ đệm ứng dụng
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return redirect()->route('home_page');
});

// Xóa bộ nhớ cache của Route
Route::get('/clear-route', function() {
    Artisan::call('route:clear');
    return redirect()->route('home_page');
});

// Xóa bộ nhớ cache cấu hình
Route::get('/clear-config', function() {
    Artisan::call('config:clear');
    return redirect()->route('home_page');
});

// Xóa bộ nhớ cache của các view đã được biên dịch
Route::get('/clear-view', function() {
    Artisan::call('view:clear');
    return redirect()->route('home_page');
});

// Change language
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['vi', 'en'])) {
        abort(404);
    }

    Session::put('locale', $locale);
    return redirect()->back();
});

Route::view('/done', 'test');


//TODO: Frontend

// - Home
Route::get('/', 'HomeController@home_page')->name('home_page');
Route::get('search', 'HomeController@search')->name('search');

Route::post('fetch-data-search', 'HomeController@fetch_data_search')->name('fetch_data_search');

// - Product
Route::group(['prefix' => 'product'], function () {
    Route::get('/', 'ProductController@product')->name('product');
    Route::get('/{category_slug}', 'ProductController@product_category_slug')->name('product_category_slug');
    Route::post('fetch_data', 'ProductController@fetch_data')->name('fetch_data');
    Route::get('details/{product_slug}', 'ProductController@product_detail')->name('product_detail');
    Route::get('tag/{product_tags}', 'ProductController@product_tag')->name('product_tag');

    Route::post('quick-view', 'ProductController@quick_view')->name('quick_view');

    Route::post('insert-wishlist', 'ProductController@insert_wishlist')->name('insert_wishlist');
    Route::post('delete-wishlist-image', 'ProductController@delete_wishlist_image')->name('delete_wishlist_image');

    Route::post('insert-rating', 'ProductController@insert_rating')->name('insert_rating');
});

// - Blog + Blog detail
Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'BlogController@blog')->name('blog');
    Route::get('category/{category_post_slug}', 'BlogController@blog_category')->name('blog_category');
    Route::get('details/{post_slug}', 'BlogController@blog_detail')->name('blog_detail');
    Route::get('search', 'BlogController@blog_search')->name('blog_search');
});

// Coupon, About, Contact
Route::get('coupon', 'SiteController@coupon')->name('coupon');
Route::get('about', 'SiteController@about')->name('about');
Route::get('contact', 'SiteController@contact')->name('contact');

// - Customer
Route::group(['prefix' => 'buyer'], function () {
    Route::get('login', 'Auth\LoginController@login')->name('buyer.login');
    Route::post('process-login', 'Auth\LoginController@process_login')->name('buyer.process_login');
    Route::get('register', 'Auth\RegisterController@register')->name('buyer.register');
    Route::post('process-register', 'Auth\RegisterController@process_register')->name('buyer.process_register');
    Route::get('logout', 'Auth\LoginController@logout')->name('buyer.logout');

    Route::get('forgot-password', 'Auth\ForgotPasswordController@forgot_password')->name('buyer.forgot_password');
    Route::get('reset-password', 'Auth\ResetPasswordController@reset_password')->name('buyer.reset_password');
    Route::post('update-password', 'Auth\ResetPasswordController@update_password')->name('buyer.update_password');
});

Route::post('recovery-password', 'Auth\ForgotPasswordController@recovery_password')->name('recovery_password');

Route::group(['middleware' => ['CheckCustomerLogin']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::group(['prefix' => 'account'], function () {
            Route::get('profile', 'CustomerController@profile')->name('account.profile');
            Route::match(['get', 'post'], 'update-profile', 'CustomerController@update_profile')->name('account.update_profile');

            Route::get('password', 'CustomerController@password')->name('account.password');
            Route::match(['get', 'post'], 'change-password', 'CustomerController@change_password')->name('account.change_password');
        });

        Route::group(['prefix' => 'purchase'], function () {
            Route::get('/', 'CustomerController@purchase')->name('purchase');
            Route::post('filter-order-date', 'CustomerController@filter_order_date')->name('filter_order_date');
            Route::post('show-order-date', 'CustomerController@show_order_date')->name('show_order_date');

            Route::get('order-detail/{order_code}', 'CustomerController@order_detail')->name('order_detail');
            Route::post('cancel-order', 'CustomerController@cancel_order')->name('cancel_order');
        });

        Route::group(['prefix' => 'wishlist'], function () {
            Route::get('/', 'CustomerController@wishlist')->name('wishlist');
            Route::post('deleteWishlist', 'CustomerController@deleteWishlist')->name('wishlist.deleteWishlist');
        });
    });
});

// - Cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@view_cart')->name('view_cart');
    Route::post('save-cart-simple', 'CartController@save_cart_simple')->name('save_cart_simple');
    Route::post('save-cart-multiple', 'CartController@save_cart_multiple')->name('save_cart_multiple');

    Route::get('update-num-cart/{product_id}/{type}', 'CartController@update_num_cart')->name('update_num_cart');
    Route::post('update-all-num-cart' , 'CartController@update_all_num_cart')->name('update_all_num_cart');

    Route::post('delete-cart', 'CartController@delete_cart')->name('delete_cart');
    Route::get('delete-all-cart', 'CartController@delete_all_cart')->name('delete_all_cart');
    Route::post('delete-cart-image', 'CartController@delete_cart_image')->name('delete_cart_image');
});

// - Delivery
Route::post('select-delivery-cart', 'CartController@select_delivery_cart')->name('select_delivery_cart');
Route::post('calculate-feeship' , 'CartController@calculate_feeship')->name('calculate_feeship');
Route::get('unset-delivery', 'CartController@unset_delivery')->name('unset_delivery');

// - Coupon
Route::post('check-coupon', 'CartController@check_coupon')->name('check_coupon');
Route::get('unset-coupon', 'CartController@unset_coupon')->name('unset_coupon');

// - Checkout
Route::group(['middleware' => ['CheckCustomerLogin']], function () {
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', 'CheckoutController@checkout')->name('checkout');

        Route::get('update-num-cart-checkout/{product_id}/{type}', 'CheckoutController@update_num_cart_checkout');
        Route::post('update_all_num_cart_checkout', 'CheckoutController@update_all_num_cart_checkout')->name('update_all_num_cart_checkout');

        Route::post('confirm-order', 'CheckoutController@confirm_order')->name('confirm_order');
    });
});

// - Social
Route::get('login-customer-google', 'SocialController@login_customer_google')->name('login_customer_google');
Route::get('customer/google/callback', 'SocialController@callback_customer_google')->name('callback_customer_google');

Route::get('login-customer-facebook', 'SocialController@login_customer_facebook')->name('login_customer_facebook');
Route::get('customer/facebook/callback', 'SocialController@callback_customer_facebook')->name('callback_customer_facebook');

// - Comment
Route::post('load-comment', 'CommentController@load_comment')->name('load_comment');
Route::post('load-comment-date', 'CommentController@load_comment_date')->name('load_comment_date');
Route::post('send-comment', 'CommentController@send_comment')->name('send_comment');

Route::post('counter-comment', 'CommentController@counter_comment')->name('counter_comment');
Route::post('thumbs-like', 'CommentController@thumbs_like')->name('thumbs_like');
Route::post('thumbs-dislike', 'CommentController@thumbs_dislike')->name('thumbs_dislike');

Route::post('thumbs-admin-like', 'CommentController@thumbs_admin_like')->name('thumbs_admin_like');
Route::post('thumbs-admin-dislike', 'CommentController@thumbs_admin_dislike')->name('thumbs_admin_dislike');


// - Mail


// - Support
Route::group(['prefix' => 'support'], function () {
    Route::get('transport', 'SupportController@transport')->name('transport');
    Route::get('payment-guide', 'SupportController@payment_guide')->name('payment_guide');
});

// -----------------------------------------------------------------------------------------------------------------------

//TODO: Backend

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['CheckAdminSession']], function () {
        // Login
        Route::get('login', 'AdminController@getLogin')->name('admin.getLogin');
        Route::post('login', 'AdminController@postLogin')->name('admin.postLogin');
        // Forgot Password
        Route::view('forgot-password', 'admin.forgot_password')->name('admin.forgot_password');
    });

    Route::get('logout', 'AdminController@getLogout')->name('admin.getLogout');
    Route::get('profile/{id}', 'AdminController@profile')->name('admin.profile');
    Route::post('update-profile/{id}' , 'AdminController@update_profile')->name('update_profile');
    Route::post('change-password/{id}' , 'AdminController@change_password')->name('change_password');

    Route::post('recovery-password', 'AdminController@recovery_password')->name('admin.recovery_password');
    Route::get('reset-password', 'AdminController@reset_password')->name('admin.reset_password');
    Route::post('update-password', 'AdminController@update_password')->name('admin.update_password');

    // Register
    Route::get('register', 'AdminController@getRegister')->name('admin.getRegister');
    Route::match(['get', 'post'], 'register-auth', 'AdminController@postRegister')->name('admin.postRegister');
});

Route::group(['middleware' => 'CheckAdminLogin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Controller@dashboard')->name('dashboard');
        Route::post('revenue-data', 'Controller@revenue_data')->name('revenue_data');
        Route::post('profit-data', 'Controller@profit_data')->name('profit_data');
        Route::post('order-status-data', 'Controller@order_status_data')->name('order_status_data');
        Route::post('load-order-status-data', 'Controller@load_order_status_data')->name('load_order_status_data');
        Route::get('dashboardMC', 'Controller@dashboardMC')->name('dashboardMC');
        Route::get('dashboardPCM', 'Controller@dashboardPCM')->name('dashboardPCM');
        Route::get('dashboardPSM', 'Controller@dashboardPSM')->name('dashboardPSM');
        Route::get('dashboardIM', 'Controller@dashboardIM')->name('dashboardIM');
        Route::get('dashboardCC', 'Controller@dashboardCC')->name('dashboardCC');
        // Quản lý sản phẩm

        Route::group(['prefix' => 'category'], function () {

            Route::get('/', [
                'as'         => 'category.view_all',
                'uses'       => 'CategoryController@view_all',
                'middleware' => 'checkAcl:product-category-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'category.view_insert',
                'uses'       => 'CategoryController@view_insert',
                'middleware' => 'checkAcl:product-category-management'
            ]);

            Route::post('process-insert', 'CategoryController@process_insert')->name('category.process_insert');

            Route::get('view-update/{category_id}', [
                'as'         => 'category.view_update',
                'uses'       => 'CategoryController@view_update',
                'middleware' => 'checkAcl:product-category-management'
            ]);

            Route::post('process-update/{category_id}', 'CategoryController@process_update')->name('category.process_update');

            Route::post('delete', 'CategoryController@delete')->name('category.delete');

            Route::get('unactive-category-product/{category_id}', [
                'as'         => 'category.unactive_category_product',
                'uses'       => 'CategoryController@unactive_category_product',
                'middleware' => 'checkAcl:product-category-management'
            ]);

            Route::get('active-category-product/{category_id}', [
                'as'         => 'category.active_category_product',
                'uses'       => 'CategoryController@active_category_product',
                'middleware' => 'checkAcl:product-category-management'
            ]);
        });


        Route::group(['prefix' => 'brand'], function () {

            Route::get('/', [
                'as'         => 'brand.view_all',
                'uses'       => 'BrandController@view_all',
                'middleware' => 'checkAcl:brand-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'brand.view_insert',
                'uses'       => 'BrandController@view_insert',
                'middleware' => 'checkAcl:brand-management'
            ]);

            Route::post('process-insert', 'BrandController@process_insert')->name('brand.process_insert');

            Route::get('view-update/{brand_id}', [
                'as'         => 'brand.view_update',
                'uses'       => 'BrandController@view_update',
                'middleware' => 'checkAcl:brand-management'
            ]);

            Route::post('process-update', 'BrandController@process_update')->name('brand.process_update');

            Route::post('delete', 'BrandController@delete')->name('brand.delete');

            Route::get('unactive-brand-product/{brand_id}', [
                'as'         => 'brand.unactive_brand_product',
                'uses'       => 'BrandController@unactive_brand_product',
                'middleware' => 'checkAcl:brand-management'
            ]);

            Route::get('active-brand-product/{brand_id}', [
                'as'         => 'brand.active_brand_product',
                'uses'       => 'BrandController@active_brand_product',
                'middleware' => 'checkAcl:brand-management'
            ]);

        });

        Route::group(['prefix' => 'product'], function () {

            Route::get('/', [
                'as'         => 'product.view_all',
                'uses'       => 'ProductController@view_all',
                'middleware' => 'checkAcl:product-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'product.view_insert',
                'uses'       => 'ProductController@view_insert',
                'middleware' => 'checkAcl:product-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'ProductController@process_insert')->name('product.process_insert');

            Route::get('view-update/{product_id}', [
                'as'         => 'product.view_update',
                'uses'       => 'ProductController@view_update',
                'middleware' => 'checkAcl:product-management'
            ]);

            Route::post('process-update/{product_id}', 'ProductController@process_update')->name('product.process_update');
            Route::post('delete', 'ProductController@delete')->name('product.delete');

            Route::match(['get', 'post'], 'filter', 'ProductController@filter')->name('product.filter');

            Route::get('unactive-product/{product_id}', 'ProductController@unactive_product')->name('product.unactive_product');
            Route::get('active-product/{product_id}', 'ProductController@active_product')->name('product.active_product');

            // Up ảnh cục bộ ckeditor
            Route::post('/uploads-ckeditor', 'ProductController@uploads_ckeditor');
            // Lấy ảnh từ cục bộ ckeditor
            Route::get('/file-browser', 'ProductController@file_browser');

            Route::post('import-product-excel', 'ProductController@import_product_excel')->name('import_product_excel');
            Route::post('export-product-excel', 'ProductController@export_product_excel')->name('export_product_excel');

        });

        Route::group(['prefix' => 'gallery'], function () {

            Route::get('/{product_id}', [
                'as'         => 'gallery',
                'uses'       => 'GalleryController@gallery',
                'middleware' => 'checkAcl:product-management'
            ]);

            Route::match(['get', 'post'], 'insert-gallery/{product_id}', 'GalleryController@insert_gallery')->name('gallery.insert_gallery');
            Route::post('select-gallery', 'GalleryController@select_gallery')->name('gallery.select_gallery');
            Route::post('update-gallery', 'GalleryController@update_gallery')->name('gallery.update_gallery');
            Route::post('delete-gallery', 'GalleryController@delete_gallery')->name('gallery.delete_gallery');
        });

        Route::group(['prefix' => 'review'], function () {

            Route::get('/{product_id}', [
                'as'         => 'review',
                'uses'       => 'ReviewController@review',
                'middleware' => 'checkAcl:product-management'
            ]);

            Route::post('delete-review', 'ReviewController@delete_review')->name('review.delete_review');

        });

        Route::group(['prefix' => 'coupon'], function () {

            Route::get('/', [
                'as'         => 'coupon.view_all',
                'uses'       => 'CouponController@view_all',
                'middleware' => 'checkAcl:discount-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'coupon.view_insert',
                'uses'       => 'CouponController@view_insert',
                'middleware' => 'checkAcl:discount-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'CouponController@process_insert')->name('coupon.process_insert');

            Route::get('view-update/{coupon_id}', [
                'as'         => 'coupon.view_update',
                'uses'       => 'CouponController@view_update',
                'middleware' => 'checkAcl:discount-management'
            ]);

            Route::post('process-update/{coupon_id}', 'CouponController@process_update')->name('coupon.process_update');
            Route::post('delete', 'CouponController@delete')->name('coupon.delete');

            Route::post('import-coupon-excel', 'CouponController@import_coupon_excel')->name('import_coupon_excel');
            Route::post('export-coupon-excel', 'CouponController@export_coupon_excel')->name('export_coupon_excel');

            Route::get('send-coupon-normal/{coupon_code}', [
                'as'         => 'send_coupon_normal',
                'uses'       => 'MailController@send_coupon_normal',
                'middleware' => 'checkAcl:discount-management'
            ]);

            Route::get('send-coupon-vip/{coupon_code}', [
                'as'         => 'send_coupon_vip',
                'uses'       => 'MailController@send_coupon_vip',
                'middleware' => 'checkAcl:discount-management'
            ]);

        });

        Route::group(['prefix' => 'delivery'], function () {

            Route::get('/', [
                'as'         => 'delivery',
                'uses'       => 'DeliveryController@delivery',
                'middleware' => 'checkAcl:shipping-fee-management'
            ]);

            Route::post('select-delivery', 'DeliveryController@select_delivery')->name('delivery.select_delivery');
            Route::post('insert-delivery', 'DeliveryController@insert_delivery')->name('delivery.insert_delivery');
            Route::get('select-feeship', 'DeliveryController@select_feeship')->name('delivery.select_feeship');
            Route::post('update-feeship', 'DeliveryController@update_feeship')->name('delivery.update_feeship');
        });

        Route::group(['prefix' => 'comment'], function () {

            Route::get('/', [
                'as'         => 'comment.view_all',
                'uses'       => 'CommentController@view_all',
                'middleware' => 'checkAcl:customer-comment-management'
            ]);

            Route::post('approve', 'CommentController@approve')->name('comment.approve');
            Route::post('reply-comment', 'CommentController@reply_comment')->name('comment.reply_comment');

            Route::post('delete', 'CommentController@delete')->name('comment.delete');
        });

        // Quản lý đơn hàng

        Route::group(['prefix' => 'm-order'], function () {

            Route::get('/', [
                'as'         => 'm-order.manage_order',
                'uses'       => 'OrderController@manage_order',
                'middleware' => 'checkAcl:order-management'
            ]);

            Route::get('view-order/{order_code}', [
                'as'         => 'm-order.view_order',
                'uses'       => 'OrderController@view_order',
                'middleware' => 'checkAcl:order-management'
            ]);

            Route::get('update-order/{order_code}', [
                'as'         => 'm-order.update_order',
                'uses'       => 'OrderController@update_order',
                'middleware' => 'checkAcl:order-management'
            ]);

            Route::get('print-order/{check_code}', [
                'as'         => 'm-order.print_order',
                'uses'       => 'OrderController@print_order',
                'middleware' => 'checkAcl:order-management'
            ]);

            Route::post('update-status-order' , 'OrderController@update_status_order')->name('m-order.update_status_order');
            Route::post('update-order-qty' , 'OrderController@update_order_qty')->name('m-order.update_order_qty');
        });

        // Quản lý bài viết

        Route::group(['prefix' => 'category-post'], function () {

            Route::get('/', [
                'as'         => 'category-post.view_category_post',
                'uses'       => 'BlogController@view_category_post',
                'middleware' => 'checkAcl:post-category-management'
            ]);

            Route::get('insert-category-post', [
                'as'         => 'category-post.insert_category_post',
                'uses'       => 'BlogController@insert_category_post',
                'middleware' => 'checkAcl:post-category-management'
            ]);

            Route::match(['get', 'post'], 'process-insert-category-post', 'BlogController@process_insert_category_post')->name('category-post.process_insert_category_post');

            Route::get('insert-category-post', [
                'as'         => 'category-post.insert_category_post',
                'uses'       => 'BlogController@insert_category_post',
                'middleware' => 'checkAcl:post-category-management'
            ]);

            Route::get('update-category-post/{category_post_id}', [
                'as'         => 'category-post.update_category_post',
                'uses'       => 'BlogController@update_category_post',
                'middleware' => 'checkAcl:post-category-management'
            ]);

            Route::post('process-update-category-post/{category_post_id}', 'BlogController@process_update_category_post')->name('category-post.process_update_category_post');
            Route::post('delete-category-post', 'BlogController@delete_category_post')->name('category-post.delete_category_post');

            Route::get('unactive-category-post/{category_post_id}', [
                'as'         => 'category-post.unactive_category_post',
                'uses'       => 'BlogController@unactive_category_post',
                'middleware' => 'checkAcl:post-category-management'
            ]);

            Route::get('active-category-post/{category_post_id}', [
                'as'         => 'category-post.active_category_post',
                'uses'       => 'BlogController@active_category_post',
                'middleware' => 'checkAcl:post-category-management'
            ]);

        });

        Route::group(['prefix' => 'posts'], function () {

            Route::get('/', [
                'as'         => 'posts.view_post',
                'uses'       => 'BlogController@view_post',
                'middleware' => 'checkAcl:post-management'
            ]);

            Route::get('insert-post', [
                'as'         => 'posts.insert_post',
                'uses'       => 'BlogController@insert_post',
                'middleware' => 'checkAcl:post-management'
            ]);

            Route::match(['get', 'post'], 'process-insert-post', 'BlogController@process_insert_post')->name('posts.process_insert_post');

            Route::get('update-post/{post_id}', [
                'as'         => 'posts.update_post',
                'uses'       => 'BlogController@update_post',
                'middleware' => 'checkAcl:post-management'
            ]);

            Route::post('process-update-post/{post_id}', 'BlogController@process_update_post')->name('posts.process_update_post');
            Route::post('delete-post', 'BlogController@delete_post')->name('posts.delete_post');

            Route::get('unactive-post/{post_id}', [
                'as'         => 'posts.unactive_post',
                'uses'       => 'BlogController@unactive_post',
                'middleware' => 'checkAcl:post-management'
            ]);

            Route::get('active-post/{post_id}', [
                'as'         => 'posts.active_post',
                'uses'       => 'BlogController@active_post',
                'middleware' => 'checkAcl:post-management'
            ]);

        });

        // Quản lý giao diện

        Route::group(['prefix' => 'slider'], function () {

            Route::get('/', [
                'as'         => 'slider.view_all',
                'uses'       => 'SliderController@view_all',
                'middleware' => 'checkAcl:slider-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'slider.view_insert',
                'uses'       => 'SliderController@view_insert',
                'middleware' => 'checkAcl:slider-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'SliderController@process_insert')->name('slider.process_insert');

            Route::get('view-update/{slider_id}', [
                'as'         => 'slider.view_update',
                'uses'       => 'SliderController@view_update',
                'middleware' => 'checkAcl:slider-management'
            ]);

            Route::post('process-update/{slider_id}', 'SliderController@process_update')->name('slider.process_update');
            Route::post('delete', 'SliderController@delete')->name('slider.delete');

            Route::get('unactive-slider/{slider_id}', [
                'as'         => 'slider.unactive_slider',
                'uses'       => 'SliderController@unactive_slider',
                'middleware' => 'checkAcl:slider-management'
            ]);

            Route::get('active-slider/{slider_id}', [
                'as'         => 'slider.active_slider',
                'uses'       => 'SliderController@active_slider',
                'middleware' => 'checkAcl:slider-management'
            ]);

        });


        Route::group(['prefix' => 'contact'], function () {

            Route::get('/', [
                'as'         => 'contact.view_all',
                'uses'       => 'ContactController@view_all',
                'middleware' => 'checkAcl:contact-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'contact.view_insert',
                'uses'       => 'ContactController@view_insert',
                'middleware' => 'checkAcl:contact-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'ContactController@process_insert')->name('contact.process_insert');

            Route::get('view-update/{contact_id}', [
                'as'         => 'contact.view_update',
                'uses'       => 'ContactController@view_update',
                'middleware' => 'checkAcl:contact-management'
            ]);

            Route::post('process-update/{contact_id}', 'ContactController@process_update')->name('contact.process_update');
            Route::post('delete', 'ContactController@delete')->name('contact.delete');

            Route::get('unactive-contact/{contact_id}', [
                'as'         => 'contact.unactive_contact',
                'uses'       => 'ContactController@unactive_contact',
                'middleware' => 'checkAcl:contact-management'
            ]);

            Route::get('active-contact/{contact_id}', [
                'as'         => 'contact.active_contact',
                'uses'       => 'ContactController@active_contact',
                'middleware' => 'checkAcl:contact-management'
            ]);

        });

        // Giao diện khách hàng

        Route::group(['prefix' => 'customer'], function () {

            Route::get('/', [
                'as'         => 'customer.view_all',
                'uses'       => 'CustomerController@view_all',
                'middleware' => 'checkAcl:customer-management'
            ]);

            Route::get('unactive-customer/{customer_id}', [
                'as'         => 'customer.unactive_customer',
                'uses'       => 'CustomerController@unactive_customer',
                'middleware' => 'checkAcl:customer-management'
            ]);

            Route::get('active-customer/{customer_id}', [
                'as'         => 'customer.active_customer',
                'uses'       => 'CustomerController@active_customer',
                'middleware' => 'checkAcl:customer-management'
            ]);

            Route::get('view-customer/{customer_id}', [
                'as'         => 'customer.view_customer',
                'uses'       => 'CustomerController@view_customer',
                'middleware' => 'checkAcl:customer-management'
            ]);

            Route::get('history-order/{customer_id}', [
                'as'         => 'customer.history_order',
                'uses'       => 'CustomerController@history_order',
                'middleware' => 'checkAcl:customer-management'
            ]);

            Route::post('delete', 'CustomerController@delete')->name('customer.delete');
        });

        Route::group(['prefix' => 'supplier'], function () {

            Route::get('/', [
                'as'         => 'supplier.view_all',
                'uses'       => 'SupplierController@view_all',
                'middleware' => 'checkAcl:supplier-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'supplier.view_insert',
                'uses'       => 'SupplierController@view_insert',
                'middleware' => 'checkAcl:supplier-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'SupplierController@process_insert')->name('supplier.process_insert');

            Route::get('view-update/{supplier_id}', [
                'as'         => 'supplier.view_update',
                'uses'       => 'SupplierController@view_update',
                'middleware' => 'checkAcl:supplier-management'
            ]);

            Route::post('process-update/{supplier_id}', 'SupplierController@process_update')->name('supplier.process_update');
            Route::post('delete', 'SupplierController@delete')->name('supplier.delete');

            Route::get('unactive-supplier/{supplier_id}', [
                'as'         => 'supplier.unactive_supplier',
                'uses'       => 'SupplierController@unactive_supplier',
                'middleware' => 'checkAcl:supplier-management'
            ]);

            Route::get('active-supplier/{supplier_id}', [
                'as'         => 'supplier.active_supplier',
                'uses'       => 'SupplierController@active_supplier',
                'middleware' => 'checkAcl:supplier-management'
            ]);
        });

        // Giao diện hệ thống

        Route::group(['prefix' => 'users'], function () {

            Route::get('/', [
                'as'         => 'users.view_all',
                'uses'       => 'UserController@view_all',
                'middleware' => 'checkAcl:user-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'users.view_insert',
                'uses'       => 'UserController@view_insert',
                'middleware' => 'checkAcl:user-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'UserController@process_insert')->name('users.process_insert');

            Route::get('view-role/{id}', [
                'as'         => 'users.view_role',
                'uses'       => 'UserController@view_role',
                'middleware' => 'checkAcl:user-management'
            ]);

            Route::post('process-role/{id}', 'UserController@process_role')->name('users.process_role');

            Route::get('view-permission/{id}', [
                'as'         => 'users.view_permission',
                'uses'       => 'UserController@view_permission',
                'middleware' => 'checkAcl:user-management'
            ]);

            Route::get('view-update/{id}', [
                'as'         => 'users.view_update',
                'uses'       => 'UserController@view_update',
                'middleware' => 'checkAcl:user-management'
            ]);

            Route::post('delete', 'UserController@delete')->name('users.delete');
        });

        Route::group(['prefix' => 'roles'], function () {

            Route::get('/', [
                'as'         => 'roles.view_all',
                'uses'       => 'RoleController@view_all',
                'middleware' => 'checkAcl:user-role-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'roles.view_insert',
                'uses'       => 'RoleController@view_insert',
                'middleware' => 'checkAcl:user-role-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'RoleController@process_insert')->name('roles.process_insert');

            Route::get('view-update/{id}', [
                'as'         => 'roles.view_update',
                'uses'       => 'RoleController@view_update',
                'middleware' => 'checkAcl:user-role-management'
            ]);

            Route::post('process-update/{id}', 'RoleController@process_update')->name('roles.process_update');

            Route::get('view-permission/{id}', [
                'as'         => 'roles.view_permission',
                'uses'       => 'RoleController@view_permission',
                'middleware' => 'checkAcl:user-role-management'
            ]);

            Route::post('process-permission/{id}', 'RoleController@process_permission')->name('roles.process_permission');

            Route::post('delete', 'RoleController@delete')->name('roles.delete');

        });

        Route::group(['prefix' => 'permissions'], function () {

            Route::get('/', [
                'as'         => 'permissions.view_all',
                'uses'       => 'PermissionController@view_all',
                'middleware' => 'checkAcl:user-permission-management'
            ]);

            Route::get('view-insert', [
                'as'         => 'permissions.view_insert',
                'uses'       => 'PermissionController@view_insert',
                'middleware' => 'checkAcl:user-permission-management'
            ]);

            Route::match(['get', 'post'], 'process-insert', 'PermissionController@process_insert')->name('permissions.process_insert');

            Route::get('view-update/{id}', [
                'as'         => 'permissions.view_update',
                'uses'       => 'PermissionController@view_update',
                'middleware' => 'checkAcl:user-permission-management'
            ]);

            Route::post('process-update/{id}', 'PermissionController@process_update')->name('permissions.process_update');
            Route::post('delete', 'PermissionController@delete')->name('permissions.delete');
        });

        // Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
        //     \UniSharp\LaravelFilemanager\Lfm::routes();
        // });

        Route::post('filter-by-date', 'Controller@filter_by_date')->name('filter_by_date');
        Route::post('filter-by-select', 'Controller@filter_by_select')->name('filter_by_select');
        Route::post('days-order', 'Controller@days_order')->name('days_order');

        // Tổng quan
        Route::group(['prefix' => 'statistic'], function () {
            Route::group(['prefix' => 'sales'], function () {

                Route::get('/', [
                    'as'         => 'statistic.sales.timer',
                    'uses'       => 'StatisticalController@timer',
                    'middleware' => 'checkAcl:revenue-statistics'
                ]);

                Route::post('pdf-timer', [
                    'as'         => 'statistic.sales.pdf-timer',
                    'uses'       => 'StatisticalController@pdf_timer',
                    'middleware' => 'checkAcl:inventory-statistics'
                ]);

                Route::get('/customer', [
                    'as'         => 'statistic.sales.customer',
                    'uses'       => 'StatisticalController@customer',
                    'middleware' => 'checkAcl:revenue-statistics'
                ]);

                Route::get('/product', [
                    'as'         => 'statistic.sales.product',
                    'uses'       => 'StatisticalController@product',
                    'middleware' => 'checkAcl:revenue-statistics'
                ]);

                Route::post('filter-by-date-timer', 'StatisticalController@filter_by_date_timer')->name('statistic.sales.filter_by_date_timer');
                Route::post('filter-by-date-customer', 'StatisticalController@filter_by_date_customer')->name('statistic.sales.filter_by_date_customer');
                Route::post('filter-by-date-product', 'StatisticalController@filter_by_date_product')->name('statistic.sales.filter_by_date_product');

                Route::get('export-sale-excel', 'StatisticalController@export_sale_excel')->name('export_sale_excel');
            });

            Route::group(['prefix' => 'inventory'], function () {
                Route::get('/', [
                    'as'         => 'statistic.inventory.inventory',
                    'uses'       => 'StatisticalController@inventory',
                    'middleware' => 'checkAcl:inventory-statistics'
                ]);

                Route::post('pdf-inventory', [
                    'as'         => 'statistic.inventory.pdf-inventory',
                    'uses'       => 'StatisticalController@pdf_inventory',
                    'middleware' => 'checkAcl:inventory-statistics'
                ]);
            });

            Route::group(['prefix' => 'bill'], function () {
                Route::get('/', [
                    'as'         => 'statistic.bill.bill',
                    'uses'       => 'StatisticalController@bill',
                    'middleware' => 'checkAcl:bill-statistics'
                ]);

                Route::post('pdf-bill', [
                    'as'         => 'statistic.bill.pdf-bill',
                    'uses'       => 'StatisticalController@pdf_bill',
                    'middleware' => 'checkAcl:bill-statistics'
                ]);
            });

        });
    });
});


