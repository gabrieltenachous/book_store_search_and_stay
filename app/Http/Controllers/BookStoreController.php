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
    public function store(BookStoreRequest $request)
    { 
        $book_store = BookStore::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
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
    public function show($id)
    {
        $book_store = BookStore::with('user')->find($id); 
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
    public function update(BookStoreRequest $request, $id)
    {
        $book_store = BookStore::with('user')->find($id); 
        if($book_store){
            BookStore::updateOrCreate(
                [
                    'id'=>$id
                ],
                array_merge($request->all(), ['user_id' => Auth::user()->id])
            );
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
    public function destroy($id)
    { 
        $book_store = BookStore::find($id);  
        if($book_store){
            $book_store->delete();
            return response()->json(
                [
                    'message'=>'Book store deleted successfully','book_store'=>$book_store
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
}
