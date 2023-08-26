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

Route::get('/', function () {
    return view('welcome');
});
Route::get('clear-cache', function () {
    \Artisan::call('optimize:clear');
    return back();
});
Route::get('clear-routes', function () {
    \Artisan::call('route:clear');
    dd("Routes Cleared");
});
Route::get('clear-config', function () {
    \Artisan::call('config:clear');
    dd("config Cleared");
});
Route::get('migrate-fresh', function () {
    \Artisan::call('migrate:fresh');
    dd("Migration Freshed");
});
Route::get('migrate', function () {
    \Artisan::call('migrate');
    dd("Migration Completed");
});
Route::get('seed', function () {
    \Artisan::call('db:seed');
    dd("Seeding Completed");
});
Route::get('storage-link', function () {
    \Artisan::call('storage:link');
    dd("links Completed");
});
Route::get('passport-install', function () {
    \Artisan::call('passport-install');
    dd("links Completed");
});
