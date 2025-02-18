<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            return view('blog.blogs.blogs');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        $data['image'] = Storage::putFile('blogs',$request->image);
        $data['user_id'] = Auth::user()->id;
        Blog::create($data);
        return back()->with('status','blog added successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view("blog.blog-details",compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {

            return view('blog.blogs.edit-blog',compact('blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {

            $edit_blog=Blog::findOrFail($blog->id);
            $data= $request->validated();
            if ($request->has("image")) {

                Storage::delete($edit_blog->image);
                $data['image']=Storage::putFile("blogs", $request->image);
            }else {
                $data['image']=$edit_blog->image;
            }
            $blog->update($data);
            return back()->with("edit-status","blog updated successfully");
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {

            $data=$blog->findOrFail($blog->id);
            Storage::delete($blog->image);
            $data->delete();
            return back()->with("delete-status","blog deleted successfully");
        }
        abort(403);

    }

    public function myBlog() {

        $blog = Blog::where("user_id",Auth::user()->id)->paginate(2);

        return view("blog.blogs.myblog",compact('blog'));
    }
}
