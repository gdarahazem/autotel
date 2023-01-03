<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\admin\RegisteredUserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashBoardAdminController;
use App\Http\Controllers\EstimationPriceController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PhonesSearchesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::prefix('admin')->group(function () {
    require __DIR__ . '/authAdmin.php';
    Route::group(['middleware' => ['auth:admin', 'verified:admin.verification.notice']], function () {

        Route::get('/',[DashBoardAdminController::class, 'index'])
            ->name('admin.dashboard');

        Route::get("/phones/{param?}", [PhoneController::class, "phonesListeWithSearch"])
            ->name('admin.index.home');

        Route::get("/phonesBuyer/{param?}", [PhonesSearchesController::class, "phonesListeWithSearch"])
            ->name('admin.phone.buyer');

        Route::get("/postsDelete/{phone}", [PhoneController::class, "delete"])
            ->name("posts.delete");
        Route::get("/phonesBuyerDelete/{phonesSearch}", [PhonesSearchesController::class, "destroy"])
            ->name("phone.buyer.delete");

        Route::get("/postsearch/{search?}", [PhoneController::class, "searchProductByName"])
            ->name('admin.search.phone.name');

        Route::controller(UserController::class)->group(function () {
            Route::get('/editPictures', 'editPictures')
                ->name('pictures.edit');
            Route::put('/updateLogo', 'updateLogo')
                ->name('logo.update');
            Route::put('/updateBackground', 'updateBackground')
                ->name('background.update');
            Route::get("/users", 'index')
                ->name("users.index");
            Route::put('/users/{admin?}', "update")
                ->name('users.update');
            Route::get('/users/{admin?}', "desactivateAccount")
                ->name('users.desactivateAccount');
            Route::post('/users/{admin?}', "changePassword")
                ->name('users.changePassword');
        });
        Route::controller(AdminController::class)->group(function () {

            Route::get('/editProfile/{admin?}', 'updateProfile')
                ->name('admin.update.profile');
            Route::post('/editProfile/{admin?}', 'storeUpdateProfile')
                ->name('admin.store.update.profile');
            Route::post('/editPictures', "editPictures")
                ->name('admin.pictures.edit');

        });
        Route::post('register', [RegisteredUserController::class, 'store'])
            ->name('admin.register');

        Route::controller(MarksController::class)->group(function () {
            Route::get('/mark', 'index')
                ->name('mark.index');
            Route::post('/mark/', 'store')
                ->name('mark.store');
            Route::put('/mark/update/{mark?}', 'update')
                ->name('mark.update');
            Route::delete('/mark/{mark?}', 'destroy')
                ->name('mark.destroy');
        });

    });
});


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::controller(PhoneController::class)->group(function () {
        Route::get("/", "index")
            ->name("home.index");
        Route::get("/phones/{param?}", "phonesListeWithSearch")
            ->name("search.home.index");
        Route::get("/myposts", "myPosts")
            ->name("myposts.index");
        Route::get("/posts/{phone}", "show")
            ->name("posts.show");

        Route::post('/posts/store', 'store')
            ->name('posts.store');
        Route::put('/posts/update/{phone?}', 'update')
            ->name('posts.update');
        Route::put('/posts/update/image/{phone?}', 'updateImage')
            ->name('image.update');
        Route::get("/postsearch/{search?}", "searchProductByName")
            ->name('search.phone.name');

    });
    Route::controller(PhonesSearchesController::class)->group(function () {
        Route::get("/phonesBuyer/{param?}", "index")
            ->name("phone.buyer.index");
        Route::post('/phonesBuyer/store', 'store')
            ->name('phones.buyer.store');
        Route::get("/phoneBuyer/{phonesSearch}", "show")
            ->name("phones.buyer.show");

    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/editProfileAdmin/{user?}', 'updateProfile')
            ->name('user.update.profile');
        Route::post('/editProfileAdmin/{user}', 'storeUpdateProfile')
            ->name('user.store.update.profile');
        Route::post('/sendMailToSeller/{phone?}', 'sendMailToSeller')
            ->name('sendMail');
        Route::post('/editPictures', "editPictures")
            ->name('client.pictures.edit');
    });
    Route::controller(EstimationPriceController::class)->group(function () {
        Route::get('/estimate', 'index')
            ->name('estimate.price.index');
        Route::get('/predict', 'predict')
            ->name('predict.price');
    });

    Route::controller(BudgetController::class)->group(function () {
        Route::get('/budget', 'index')
            ->name('budget.index');
        Route::get('/budgetPredict', 'budget')
            ->name('budget.price');
    });


});
require __DIR__ . '/auth.php';
