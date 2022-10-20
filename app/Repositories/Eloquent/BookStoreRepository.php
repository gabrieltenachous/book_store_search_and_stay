<?php

namespace App\Repositories\Eloquent;

use App\Models\BookStore;
use App\Repositories\Contracts\BookStoreRepositoryInterface;

class BookStoreRepository extends AbstractRepository implements BookStoreRepositoryInterface{

    protected $model = BookStore::class;
 
}