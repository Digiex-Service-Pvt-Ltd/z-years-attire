<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;


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

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'aboutus']);
Route::get('/contact', [HomeController::class, 'contactus']);
Route::post('/contact', [HomeController::class, 'submit_contact']);

//Routes for user
Route::prefix('user')->name('user.')->group(function(){

    //Routes defined for non restricted functions
    Route::middleware(['guest:user'])->group(function(){
        Route::get('register', function(){
            return view('maincontents.user.register');
        });
        Route::post('register', [UserController::class, 'save_register_data'])->name('submit.registration');
        Route::get('login', function(){
            return view('maincontents.user.login');
        })->name('login');
        Route::post('login', [UserController::class, 'login'])->name('submit.login');
    });

    //Routes defined for login restricted function
    Route::middleware(['auth:user'])->group(function(){
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });

});

//Routes for admin
Route::prefix('admin')->name('admin.')->group(function(){

    //Routes defined for non restricted functions
    Route::middleware(['guest:admin'])->group(function(){
        Route::get('login', [AdminLoginController::class, 'index'])->name('login'); //Show login form
        Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit'); //Submit login form
    });

    //Routes defined for login restricted functions
    Route::middleware(['auth:admin'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //------------- Category :: route defined ---------------//
        Route::get('category', [CategoryController::class, 'index'])->name('category.list');
        Route::post('category/insert', [CategoryController::class, 'index'])->name('category.insert');
        Route::post('category/saveChanges', [CategoryController::class, 'save_changes'])->name('category.savechanges');
        Route::get('category/{id}', [CategoryController::class, 'get_details'])->name('category.getdetails');
        Route::post('category/update', [CategoryController::class, 'update_category'])->name('category.update');
        Route::post('category/delete', [CategoryController::class, 'delete_category'])->name('category.delete');
        Route::post('category/delete_image', [CategoryController::class, 'delete_image'])->name('category.delete_image');
        //-------------------------------------------------------//

        //------------- Attribute :: route defined ---------------//
        Route::get('attribute', [AttributeController::class, 'index'])->name('attribute.list');
        Route::post('attribute/insert', [AttributeController::class, 'insert'])->name('attribute.add');
        Route::get('attribute/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');
        Route::post('attribute/update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
        //-------------------------------------------------------//

        //------------- Attribute Value :: route defined ---------------//
        Route::get('attributeValue/{id}', [AttributeValueController::class, 'index'])->name('attributeValue.list');
        Route::post('attributeValue/insert/{id}', [AttributeValueController::class, 'insert'])->name('attributeValue.add');
        Route::get('attributeValue/edit/{attr_id}/{value_id}', [AttributeValueController::class, 'edit'])->name('attributeValue.edit');
        Route::post('attributeValue/update/{attr_id}/{value_id}', [AttributeValueController::class, 'update'])->name('attributeValue.update');
        //-------------------------------------------------------//

        //------------- Products :: route defined ---------------//
        Route::prefix('product')->name('product.')->group(function(){
            //Routes for main product
            Route::get('/', [ProductController::class, 'index'])->name('list');
            Route::get('create/main', [ProductController::class, 'create_main'])->name('create.main');
            Route::post('create/main', [ProductController::class, 'store_main_product'])->name('store.main');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
            Route::post('delete_image', [ProductController::class, 'delete_image'])->name('delete_image');
            Route::post('delete/{id}', [ProductController::class, 'delete'])->name('delete');

            //Routes for varient product
            Route::get('varient/{id}', [ProductController::class, 'manage_varient'])->name('varient');
            Route::post('varient/add/{product_id}', [ProductController::class, 'add_varient'])->name('varient.add');
            Route::post('varient/update/{varient_id}', [ProductController::class, 'update_varient'])->name('varient.update');
            Route::post('varient/delete/{varient_id}', [ProductController::class, 'delete_varient'])->name('varient.delete');

            //Routes for product images
            Route::get('images/{product_id}', [ProductController::class, 'manage_images'])->name('images');
            Route::get('images/{product_id}/{value_id}', [ProductController::class, 'manage_images'])->name('images.value'); 
            Route::post('images/upload/{product_id}', [ProductController::class, 'image_upload'])->name('images.upload'); 
            Route::post('images/delete', [ProductController::class, 'image_delete'])->name('images.delete'); 


            //Routes for product meta manegment 
            Route::get('meta/{id}', [ProductController::class,'manage_meta_details'])->name('meta');
            Route::post('meta/update/{product_id}', [ProductController::class,'update_meta_details'])->name('meta.update');
        }); 
        //-------------------------------------------------------//

        //Route::resource('pages', PageController::class);

        // admin change password //
        Route::get('changepassword', [SettingController::class, 'index'])->name('changepassword');
        Route::post('changepassword', [SettingController::class, 'change_password'])->name('changepassword.submit');

        //admin logout
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout'); //Submit logout
    });

});

