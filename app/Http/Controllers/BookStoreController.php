<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\BookStoreRequest; 
use App\Repositories\Contracts\BookStoreRepositoryInterface; 
use Illuminate\Http\Request; 

class BookStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookStoreRepositoryInterface $model)
    {
        $book_store = $model->all(); 
        
        return response()->json(
            [
                'message'=>'Book store returned successfully','book_store'=>$book_store
            ], 200
        );
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRepositoryInterface $model,BookStoreRequest $request)
    { 
        $request_all = $request->all();
        $book_store = $model->create($request_all);
        $book_store_category = [];  
        if(isset($request_all["book_stores_categories"])){
            foreach($request_all["book_stores_categories"] as $object){ 
                $book_store_category[] = $book_store->book_stores_categories()->create(
                    ['category_id' => $object["category_id"]]
                ); 
            }
        }
        return response()->json(
            [
                'message'=>'Book store created successfully',
                'book_store'=>$book_store,
                'book_store_category'=>$book_store_category
            ], 200
        );
    }

    /**
     * Display listing with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(BookStoreRepositoryInterface $model,Request $request)
    {   
        $category = $model->paginate($request->limit ?? 10); 
        
        return response()->json(
            [
                'message'=>'Category returned successfully','category'=>$category
            ], 200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BookStoreRepositoryInterface $model,$id)
    {
        $book_store = $model->find($id); 
        if($book_store){ 
            return response()->json(
                [
                    'message'=>'Book store returned successfully','book_store'=>$book_store
                ], 200
            );
        }else{
            return response()->json(
                [
                    'message'=>'Book store not exist','book_store'=>$book_store
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
    public function update(BookStoreRepositoryInterface $model ,BookStoreRequest $request,$id)
    { 
        $request_all = $request->all(); 
        
        $book_store = $model->update([
            'name'=>$request_all["name"],
            'isbn'=>$request_all["isbn"],   
            'value'=>$request_all["value"],
        ],$id);  
        $book_store_category = [];
        if($book_store){ 
            if(isset($request_all["book_stores_categories"])){
                foreach($request_all["book_stores_categories"] as $object){     
                    $book_store->book_stores_categories()->update(
                        [
                            'category_id' => $object["category_id"]
                        ], 
                        $object["id"] 
                    ); 
                    $book_store_category[] = $model->find($object["id"]);
                }
            }
            
            return response()->json(
                [
                    'message'=>'Book store updated successfully',
                    'book_store'=>$book_store,
                    'book_store_category'=>$book_store_category
                ], 200
            );
        }else{  
            return response()->json(
                [
                    'message'=>'Book store not exist',
                    'book_store'=>$book_store,
                    'book_store_category'=>$book_store_category
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
    public function destroy(BookStoreRepositoryInterface $model,$id)
    { 
        $book_store_find = $model->find($id); 
        
        if($book_store_find){ 
            $model->destroy($id); 
            return response()->json(
                [
                    'message'=>'Book store deleted successfully','book_store'=>$book_store_find
                ], 200
            );
        }else{ 
            return response()->json(
                [
                    'message'=>'Book store not exist','book_store'=>$book_store_find
                ], 200
            ); 
        }
    }
}
