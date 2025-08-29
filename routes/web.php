<?php

use App\Livewire\Books;
use App\Livewire\Locations;
use App\Livewire\Tools;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/books',Books::class)->name('books');
Route::get('/tools',Tools::class)->name('tools');
Route::get('/locations',Locations::class)->name('locations');


