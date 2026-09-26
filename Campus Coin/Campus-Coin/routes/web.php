<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Campus Coin
|--------------------------------------------------------------------------
| Landing (index) page. Baaki routes (auth, wallet, vendor panel) baad
| mein yahan add honge.
*/

Route::get('/', function () {
    return view('landing');
})->name('home');
