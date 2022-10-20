<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface{

    public function all();
    public function create(array $data);
    public function find($id);
    public function update(array $data,$id);
    public function destroy($id); 
    public function paginate($limit = null);
}
