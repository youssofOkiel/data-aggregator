<?php

use App\Http\Controllers\Api\ListUsers;
use Illuminate\Support\Facades\Route;

Route::get('users', ListUsers::class);
