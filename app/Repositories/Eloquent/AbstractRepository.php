<?php

namespace App\Repositories\Eloquent; 

abstract class AbstractRepository{

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    } 
    public function all(){  
        return $this->model->all();
    }
    public function create(array $data){ 
        return $this->model->create($data);
    }
    public function find($id){ 
        return $this->model->find($id);
    }
    public function destroy($id){  
        return $this->model->destroy($id); 
    }
    public function update(array $data,$id){ 
        $this->model->where('id',$id)->update($data);
        return $this->model->find($id);
    }
    protected function resolveModel(){
        return app($this->model); 
    }
    public function paginate($limit = null)
    {
        return $this->model->paginate($limit);
    }
    
}