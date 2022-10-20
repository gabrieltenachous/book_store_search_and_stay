<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BookStore extends Model
{
    protected $table = "book_stores";
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'name',
        'isbn',
        'value',
        'user_id',
    ]; 
    protected $with = ["user","book_store_categories"];
    
    public function save(array $options = array())
    {
        $this->user_id = auth()->id();
        parent::save($options);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function book_store_categories()
    {
    	return $this->hasMany(BookStoreCategory::class);
    }
}
