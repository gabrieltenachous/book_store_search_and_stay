<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface{ 
    public function filter($attribute,$value = null);
    public function create(array $data);
}
