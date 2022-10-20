<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\BookStoreRequest; 
use App\Repositories\Contracts\BookStoreRepositoryInterface;
use Illuminate\Support\Facades\Auth; 

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
        $book_store = $model->create($request->all());
        return response()->json(
            [
                'message'=>'Book store created successfully','book_store'=>$book_store
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
        $book_store = $model->update($request->all(),$id); 
        if($book_store){ 
            return response()->json(
                [
                    'message'=>'Book store updated successfully','book_store'=>$book_store
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
