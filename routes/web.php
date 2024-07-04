<?php

use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MyController::class,('getbatches')]);
Route::post('/getskills',[MyController::class,('getsem')]);
Route::post('/insertrec',[MyController::class,('changestatus')]);