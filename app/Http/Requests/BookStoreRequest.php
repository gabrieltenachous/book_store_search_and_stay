<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':
                return [  
                    'name' => 'required|string|max:255', 
                    'isbn' => 'required|integer|between:0,999999999',
                    'value' => 'required|numeric|between:0,999999.99',
                    'book_stores_categories' => 'nullable|array',
                    'book_stores_categories.*.category_id' => 'required|integer|exists:categories,id|distinct',
                ];
                break;  
            case 'PUT': 
                return [  
                    'name' => 'required|string|max:255', 
                    'isbn' => 'required|integer|between:0,999999999',
                    'value' => 'required|numeric|between:0,999999.99',
                    'book_stores_categories' => 'nullable|array',
                    'book_stores_categories.*.category_id' => 'required|integer|exists:categories,id|distinct', 
                    'book_stores_categories.*.id' => 'required|integer|exists:book_stores_categories,id|distinct', 
                ];
                break; 
            default:
                break;
        }
        
        
    }
}
