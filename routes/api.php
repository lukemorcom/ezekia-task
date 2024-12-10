<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    require base_path('routes/api/users.php');

    // add more as required
});
