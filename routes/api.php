<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
//    ->middleware('auth:sanctum')
    ->group(function (){
        require __DIR__ . '/api/v1/comments.php';
        require __DIR__ . '/api/v1/posts.php';
        require __DIR__ . '/api/v1/users.php';
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



