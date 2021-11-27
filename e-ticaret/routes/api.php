<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopcartController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Shopcart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    if (Auth::check()) {
        return $request->user();
    } else {
        return "";
    }
});
Route::get('categories', [CategoryController::class, 'category']);

Route::get('products', [ProductsController::class, 'product']);
Route::get('product/{array?}', [ProductsController::class, 'productForCategory']);
Route::post('addProduct', [ShopcartController::class, 'addProduct']);
Route::post('deleteProduct', [ShopcartController::class, 'deleteProduct']);
Route::post('changequantity', [ShopcartController::class, 'changequantity']);
Route::get('shopcarts', [ShopcartController::class, 'shopcarts']);
Route::get('follows', [FollowController::class, 'follows']);
Route::post('addfollows', [FollowController::class, 'addfollows']);
Route::post('unfollows', [FollowController::class, 'unfollows']);
Route::get('getproduct/{slug}', [ProductsController::class, 'getProduct']);

Route::post('createuser', [UserController::class, 'createuser']);

Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout']);
Route::post('updateuser', [UserController::class, 'updateUser']);

Route::get('editactivation/{activation}', [UserController::class, 'editactivation']);
Route::post('getreviews', [ReviewController::class, 'getreviews']);
Route::post('sendreview', [ReviewController::class, 'sendreview']);
Route::post('sendmessage', [MessageController::class, 'sendmessage']);




//#####################################################   ADMİN   ##################################################//

Route::group(['middleware' => ['auth','admin']], function () {

            //########### User ###########//
            Route::get('alluser', [UserController::class, 'alluser']);
            Route::post('deleteuser', [UserController::class, 'deleteuser']);
            Route::post('edituser', [UserController::class, 'edituser']);
            Route::post('editeduser', [UserController::class, 'editeduser']);

            //########### Category ###########//
            Route::post('editcategory', [CategoryController::class, 'editcategory']);
            Route::post('subcategory', [CategoryController::class, 'subcategory']);
            Route::post('editedcategory', [CategoryController::class, 'editedcategory']);
            Route::post('deletecategory', [CategoryController::class, 'deletecategory']);
            Route::get('topcategory', [CategoryController::class, 'topcategory']);
            Route::post('createcategory', [CategoryController::class, 'createcategory']);


            //########### Product ###########//
            Route::post('getcategories', [ProductsController::class, 'getcategories']);
            Route::post('deletecategoryproduct', [ProductsController::class, 'deletecategoryproduct']);
            Route::post('addproductcategory', [ProductsController::class, 'addproductcategory']);
            Route::post('deleteproduct', [ProductsController::class, 'deleteproduct']);
            Route::post('createproduct', [ProductsController::class, 'createproduct']);
            Route::post('editproduct', [ProductsController::class, 'editproduct']);
            Route::post('editedproduct', [ProductsController::class, 'editedproduct']);

            //########### Shopcarts ###########//
            Route::get('allshopcarts', [ShopcartController::class, 'allshopcarts']);
            Route::post('deleteshopcart', [ShopcartController::class, 'deleteshopcart']);


            //########### Reviews ###########//
            Route::get('allreviews', [ReviewController::class, 'allreviews']);
            Route::post('editreview', [ReviewController::class, 'editreview']);
            Route::post('editedreview', [ReviewController::class, 'editedreview']);
            Route::post('deletereview', [ReviewController::class, 'deletereview']);


            //########### Settings ###########//
            Route::get('settings', [SettingController::class, "settings"]);
            Route::post('editsettings', [SettingController::class, "editsettings"]);


            //########### Contacts ###########//
            Route::get('allmessages', [MessageController::class, "allmessages"]);
            Route::post('editmessage', [MessageController::class, "editmessage"]);
            Route::post('editedmessage', [MessageController::class, "editedmessage"]);
            Route::post('deletemessage', [MessageController::class, "deletemessage"]);
        
});
