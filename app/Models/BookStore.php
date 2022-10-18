<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BookStore extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'name',
        'isbn',
        'value',
        'user_id',
    ]; 
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
