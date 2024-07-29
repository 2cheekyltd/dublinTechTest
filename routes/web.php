<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invite-affiliates', [AffiliateController::class, 'inviteAffiliates']);
