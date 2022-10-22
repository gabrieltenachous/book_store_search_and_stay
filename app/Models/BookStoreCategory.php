<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookStoreCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "book_stores_categories";
    protected $fillable = [ 
        'category_id', 
        'book_store_id', 
    ];  
 
    
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function book_store()
    {
    	return $this->belongsTo(BookStore::class);
    }
}
