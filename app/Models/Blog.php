<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable=[
        'name','description','image','category_id','user_id'
    ];
    // define relation between categories and blogs 1 to (category) many (blogs)
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
