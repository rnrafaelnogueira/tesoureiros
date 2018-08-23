<?php
/**
 * Created by PhpStorm.
 * User: rsnogueira
 * Date: 22/08/2018
 * Time: 13:18
 */

namespace App\Repositories;


use App\Models\Mes;

class MesRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        Mes $model
    )
    {
        $this->model = $model;
    }
}