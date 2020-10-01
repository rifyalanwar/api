<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/member/add','AuthController@MemberRegister')->middleware('guest:api');
Route::post('/member/login','AuthController@MemberLogin')->middleware('auth:api');
Route::get('/login','AuthController@MemberLogin');
