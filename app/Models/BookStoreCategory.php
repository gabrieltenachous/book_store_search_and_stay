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
        'user_id',
        'category_id', 
        'book_store_id', 
    ]; 

    public function save(array $options = array())
    {
        $this->user_id = auth()->id();
        parent::save($options);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function book_store()
    {
    	return $this->belongsTo(BookStore::class);
    }
}
