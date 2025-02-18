<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::latest()->paginate(4);
        $sliderBlog=Blog::latest()->take(5)->get();
        return view("blog.index",compact('blogs','sliderBlog'));
    }

    public function contact() {
        return view("blog.contact");
    }

    public function category($id) {
        $category_name=Category::find($id)->name;
        $blogs = Blog::where("category_id",$id)->paginate(1);
        return view("blog.category",compact("blogs","category_name"));
    }
    public function login() {
        return view("blog.login");
    }
    public function register() {
        return view("blog.register");
    }
}
