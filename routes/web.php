<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FeedbackController;

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
    return view('welcome');
});

Route::get('/add', function () {
    return view('addLaptop');
});

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('adminHome', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('adminHome')->middleware('is_admin');

Route::get('/admin/profile/{id}', [UserController::class, 'showAdminProfile'])->name('adminProfile');

Route::post('/addLaptop/store',[App\Http\Controllers\laptopController::class,'add'])->name('addLaptop');

Route::get('/addDone',[App\Http\Controllers\laptopController::class,'adddones'])->name('addDone');

Route::get('/adminPage/store',[App\Http\Controllers\laptopController::class,'view'])->name('adminPage');

Route::get('/deletelaptop/{id}',[App\Http\Controllers\laptopController::class,'delete'])->name('viewlaptop.delete');

Route::get('/deleteDone',[App\Http\Controllers\laptopController::class,'deletedone'])->name('deleteDone');

Route::get('/editLaptop/{id}',[App\Http\Controllers\laptopController::class,'edit'])->name('editLaptop');

Route::post('updateLaptop/store',[App\Http\Controllers\laptopController::class,'update'])->name('updateLaptop');

Route::get('/editDone',[App\Http\Controllers\laptopController::class,'editdones'])->name('editDone');

Route::get('/adminLaptopCategory/{manufacturer}',[App\Http\Controllers\laptopController::class,'showCategorys'])->name('adminLaptopCategory');

Route::get('/adminLaptopDetails/{id}',[App\Http\Controllers\laptopController::class,'laptopDetail'])->name('adminLaptopDetails');
//select laptop
Route::get('/selectLaptop',[App\Http\Controllers\laptopController::class,'views'])->name('selectLaptop');

Route::get('/selectLaptop/store', [App\Http\Controllers\laptopController::class, 'editSearch'])->name('selectLaptop.store');

Route::get('/selectLaptop/show', [App\Http\Controllers\laptopController::class,'showLaptopByBrand'])->name('selectLaptop.show');

Route::post('/adminSearchLaptop',[App\Http\Controllers\laptopController::class,'adminSearch'])->name('adminSearchLaptop');

Route::get('adminShowAllLaptop',[App\Http\Controllers\laptopController::class,'adminLaptopList'])->name('adminShowAllLaptop');

Route::get('/adminCompareLaptop/{id}', [App\Http\Controllers\adminLaptopComparisonController::class, 'adminCompare'])->name('adminCompareLaptop');
Route::post('/adminCompareLaptop/{id}/search', [App\Http\Controllers\adminLaptopComparisonController::class, 'adminSearchAndAdd'])->name('adminCompareLaptopSearch');
Route::get('/adminCompareLaptop/{id}/add/{compareId}', [App\Http\Controllers\adminLaptopComparisonController::class, 'adminAddToComparisonList'])->name('adminCompareLaptopAdd');
Route::get('/adminCompareLaptop/{id}/remove', [App\Http\Controllers\adminLaptopComparisonController::class, 'adminRemoveComparison'])->name('adminRemoveComparison');

//user

Route::get('/user/profile/{id}', [UserController::class, 'showUserProfile'])->name('userProfile');

Route::get('/laptopCategory/{manufacturer}',[App\Http\Controllers\laptopController::class,'showCategory'])->name('laptopCategory');

Route::get('/laptopDetails/{id}',[App\Http\Controllers\laptopController::class,'details'])->name('laptopDetails');

Route::post('/searchLaptop',[App\Http\Controllers\laptopController::class,'search'])->name('searchLaptop');

Route::get('showAllLaptop',[App\Http\Controllers\laptopController::class,'laptopList'])->name('showAllLaptop');

//review
Route::post('/save-review',[ App\Http\Controllers\ReviewController::class,'saveReview'])->name('save_review');
Route::post('/load-rating-data', [App\Http\Controllers\ReviewController::class,'loadRatingData'])->name('load_rating_data');
Route::post('/load-review-data', [App\Http\Controllers\ReviewController::class,'loadReviewData'])->name('load_review_data')->withoutMiddleware(['web']);
Route::get('/reviewHistory', [App\Http\Controllers\ReviewController::class,'reviewHistory'])->name('reviewHistory');
Route::delete('/reviews/{id}', [App\Http\Controllers\ReviewController::class,'deleteReview'])->name('reviews.delete');
Route::put('/reviews/{id}/edit', [App\Http\Controllers\ReviewController::class,'editReview'])->name('reviews.edit');
Route::put('/reviews/{id}', [App\Http\Controllers\ReviewController::class,'updateReview'])->name('reviews.update');

//review.admin
Route::get('/adminReviewHistory', [App\Http\Controllers\ReviewController::class,'adminReviewHistory'])->name('adminReviewHistory');
Route::delete('/adminReviews/{id}', [App\Http\Controllers\ReviewController::class,'adminDeleteReview'])->name('adminReviews.delete');
Route::get('/reviewManage', [App\Http\Controllers\ReviewController::class,'reviewManage'])->name('reviewManage');
Route::get('/reviewManage/search', [App\Http\Controllers\ReviewController::class,'search'])->name('reviewManage.search');
Route::get('/adminReviewManage/{id}',[App\Http\Controllers\ReviewController::class,'adminReviewManage'])->name('adminReviewManage');

//compare
Route::get('/compareLaptop', [App\Http\Controllers\laptopComparisonController::class, 'compare'])->name('compareLaptop');
Route::get('/compareLaptop/search', [App\Http\Controllers\laptopComparisonController::class, 'searchLaptops'])->name('compareLaptopSearch');
Route::get('/compareLaptop/{id}/add/{compareId}', [App\Http\Controllers\laptopComparisonController::class, 'addToComparisonList'])->name('compareLaptop.add');
Route::get('/compareLaptop/{id}/remove', [App\Http\Controllers\laptopComparisonController::class, 'removeComparison'])->name('removeComparison');

//favorites
Route::post('/favorites/toggle/{laptopId}', [FavoritesController::class, 'toggleFavorite'])->name('favorites.toggle');
Route::get('/favorites', [FavoritesController::class, 'listFavorites'])->name('favoritesList')->middleware('auth');
Route::get('/adminFavorites', [FavoritesController::class, 'adminListFavorites'])->name('adminFavoritesList')->middleware('auth');
Route::delete('/favorites/remove/{favoriteId}', [FavoritesController::class, 'removeFavorite'])->name('favorites.remove');

//feedback
Route::middleware(['auth'])->group(function () {
    Route::get('/userFeedback/{id}', [App\Http\Controllers\FeedbackController::class, 'create'])->name('feedback.create');
    
    Route::post('/userFeedback/{id}/store', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

});

Route::delete('/feedback/{id}', [App\Http\Controllers\FeedbackController::class,'deleteFeedback'])->name('feedback.delete');
Route::get('/feedbackManage', [App\Http\Controllers\FeedbackController::class,'feedbackManage'])->name('feedbackManage');
Route::get('/feedbackManage/show', [App\Http\Controllers\FeedbackController::class,'showFeedbackByType'])->name('feedbackManage.show');
Route::get('/feedbackManage/search', [App\Http\Controllers\FeedbackController::class,'search'])->name('feedbackManage.search');

//filter
// Route::get('/laptopFilter', [App\Http\Controllers\laptopFilterController::class, 'index'])->name('laptopFilter.index');
// Route::get('/laptopFilter/filter', [App\Http\Controllers\LaptopFilterController::class, 'filter'])->name('laptopFilter.filter');
Route::get('/laptop-filter', [App\Http\Controllers\laptopFilterController::class, 'filter'])->name('laptopFilter.filter');

//footer
Route::get('/aboutUs', [App\Http\Controllers\HomeController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contactUs', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contactUs');
Route::get('/tutorial', [App\Http\Controllers\HomeController::class, 'tutorial'])->name('tutorial');
Route::get('/disclaimer', [App\Http\Controllers\HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/privacyPolicy', [App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

Route::get('/custom-logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('custom.logout');