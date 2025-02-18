<?php

use App\Http\Controllers\blog\BlogController;
use App\Http\Controllers\BlogController as Blogs;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;


// blog routes

Route::middleware('auth')->controller(BlogController::class)->name("blog.")->group(function () {
    Route::get("/","index")->name("index");
    Route::get("/category/{id}","category")->name("category");
    Route::get("/contact","contact")->name("contact");
});

// subscriber route

Route::post('subscriber/store',[SubscriberController::class,'store'])->name('subscriber.store');

// Contact route

Route::post('contact/store',[ContactController::class,'store'])->name('contact.store');

// Blogs route

Route::middleware('auth')->resource('blogs',Blogs::class);

// my blog

Route::get("my-blogs",[Blogs::class,'myBlog'])->name('my-blogs');

// comment route

Route::post('comment/store',[CommentController::class,'store'])->name('comment.store');


require __DIR__.'/auth.php';
