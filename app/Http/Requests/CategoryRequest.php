<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {   
        switch ($this->method()) {
            case 'POST':
                return [ 
                    'name' => 'required|string|max:255', 
                    'books_stories' => 'required|array', 
                    'books_stories.*' => 'required|integer|exists:book_stores,id|distinct', 
                ];
                break; 
            case 'PUT': 
                return [ 
                    'name' => 'required|string|max:255', 
                    'books_stories' => 'required|array', 
                    'books_stories.*.book_store_id' => 'required|integer|exists:book_stores,id|distinct', 
                    'books_stories.*.id' => 'required|integer|exists:book_stores_categories,id|distinct', 
                ];
            default:
                break;
        } 
    } 
}
