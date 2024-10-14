<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response(
        "<h1>Welcome to medicare reminder API</h1>",
        200, [
            'Content-Type' => "text/html",
        ]);
});
