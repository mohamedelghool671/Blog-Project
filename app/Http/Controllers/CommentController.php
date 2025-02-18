<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)  {
        $data=$request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "subject" => "required|string|min:10|max:30",
            "message" => "required|string|min:10|max:200",
            "blog_id" => "required|exists:blogs,id"
        ]);
      Comment::create($data);
     return back()->with("comment-status","comment pubblished successfully");
    }
}
