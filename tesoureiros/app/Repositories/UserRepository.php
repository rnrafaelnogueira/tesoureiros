<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;



class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        User $model
    )
    {
        $this->model = $model;
    }
}