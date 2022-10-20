<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepositoryInterface $model)
    {
        $category = $model->all(); 

        return response()->json(
            [
                'message'=>'Category returned successfully','category'=>$category
            ], 200
        );
    } 

    /**
     * Display listing with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(CategoryRepositoryInterface $model,Request $request)
    {
        $category = $model->paginate($request->limit ?? 10); 
        
        return response()->json(
            [
                'message'=>'Category returned successfully','category'=>$category
            ], 200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRepositoryInterface $model,CategoryRequest $request)
    {  
        $request_all = $request->all(); 
        $category = $model->create($request_all);
        $book_store_category = [];
        if(isset($request_all["book_stores_categories"])){
            foreach($request_all["book_stores_categories"] as $book_store_id){ 
                $book_store_category[] = $category->book_stores_categories()->create(
                    ['book_store_id' => $book_store_id]
                ); 
            }
        }
        return response()->json(
            [
                'message'=>'Category created successfully',
                'book_store_category'=>$book_store_category,
                'category'=>$category,

            ], 200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryRepositoryInterface $model,$id)
    {
        $category = $model->find($id); 
        if($category){
            
            return response()->json(
                [
                    'message'=>'Category returned successfully','category'=>$category
                ], 200
            );
        }else{
            return response()->json(
                [
                    'message'=>'Category not exist','category'=>$category
                ], 200
            ); 
        }
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRepositoryInterface $model ,CategoryRequest $request,$id)
    {
        $request_all = $request->all();  

        $category = $model->update(
            [
                'name'=>$request_all["name"]
            ]
        ,$id);  

        if($category){ 
            if(isset($request_all["book_stores_categories"])){
                foreach($request_all["book_stores_categories"] as $key => $book_store){ 
                    $book_store_category[] = $category->book_stores_categories()->update(
                        [
                            'book_store_id' => $book_store["book_store_id"]
                        ],
                        $book_store["id"]
                    ); 
                }
            }
            
            return response()->json(
                [
                    'message'=>'Book store updated successfully','category'=>$category
                ], 200
            );
        }else{  
            return response()->json(
                [
                    'message'=>'Category not exist','category'=>$category
                ], 200
            ); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryRepositoryInterface $model,$id)
    {
        $category = $model->find($id); 
        if($category){ 
            $model->destroy($id); 
            return response()->json(
                [
                    'message'=>'Category deleted successfully','category'=>$category
                ], 200
            );
        }else{ 
            return response()->json(
                [
                    'message'=>'Category not exist','category'=>$category
                ], 200
            ); 
        }
    }
}
