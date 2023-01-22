<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactList;

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

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home', [App\Http\Controllers\ContactList::class, 'selectContact'])->name('home');
Route::get('addContact', [App\Http\Controllers\ContactList::class, 'addContact'])->name('addContact');
Route::get('editContact', [App\Http\Controllers\ContactList::class, 'editContact'])->name('editContact');
Route::get('search', [App\Http\Controllers\ContactList::class, 'search'])->name('search');
Route::get('choice', [App\Http\Controllers\ContactList::class, 'choice'])->name('choice');