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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.home');

    Route::prefix('educations')->group(function () {
        Route::get('/', 'Admin\Educations\EducationController@index')->name('admin.edu');
        Route::get('/videos', 'Admin\Educations\VideoController@index')->name('admin.edu.videos');
        Route::get('/articles', 'Admin\Educations\ArticleController@index')->name('admin.edu.articles');

        Route::resource('photos', 'Admin\Educations\PhotoController');
        Route::resource('articles', 'Admin\Educations\ArticleController');
        Route::resource('article-categories', 'Admin\Educations\CategoryController')->only('index');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/', 'Admin\SettingController@store')->name('admin.settings.store');
        Route::get('/social-links', 'Admin\SettingController@social_links')->name('admin.settings.socials');
        Route::post('/social-links', 'Admin\SettingController@store_social_links')->name('admin.settings.socials.store');

        Route::get('/sliders', 'Admin\SettingController@sliders')->name('admin.settings.sliders');

        Route::get('/profile', 'Admin\SettingController@profile')->name('admin.settings.profile');
        Route::post('/profile', 'Admin\SettingController@store_profile')->name('admin.settings.profile.store');
    });

    Route::resource('relations', 'Admin\RelationController');

});

Route::get('/educations', 'Educations\EducationController@index')->name('edu');

Route::get('/sanggar', 'RelationController@index')->name('relation.index');
Route::get('/sanggar/{relation}/{slug}', 'RelationController@show')->name('relation.show');

Route::get('/video', 'Educations\VideoController@index')->name('edu.videos.index');
Route::get('/video/{video}', 'Educations\VideoController@show')->name('edu.videos.show');

Route::get('/foto', 'Educations\PhotoController@index')->name('edu.photos.index');
Route::get('/foto/{photo}', 'Educations\PhotoController@show')->name('edu.photos.show');

Route::get('/artikel', 'Educations\ArticleController@index')->name('edu.articles.index');
Route::get('/artikel/{article}/{slug}', 'Educations\ArticleController@show')->name('edu.articles.show');

Route::get('/pages/{page}', 'PageController@show')->name('pages');

Route::get('/donasi', 'DonationController@index')->name('donation.index');
Route::get('/donasi/{relation}/{slug}', 'DonationController@show')->name('donation.show');