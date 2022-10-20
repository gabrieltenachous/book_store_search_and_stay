<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    
    protected $table = "categories";

    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 
    ];

    protected $with = ["book_stores_categories"];

    public function book_stores_categories()
    {
    	return $this->hasMany(BookStoreCategory::class);
    }
}
