<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Links;
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

Route::get('/', [Links::class, 'home'])->name('home');
Route::get('/{shortLink}', [Links::class, 'redirect'])
    ->where('shortLink', 'l-[A-Za-z0-9]{6}')
    ->name('hash');


Route::post('/', [Links::class,'create'])->name('links.create');
Route::get('/delete/{id}', [Links::class, 'delete'])->name('links.delete');
