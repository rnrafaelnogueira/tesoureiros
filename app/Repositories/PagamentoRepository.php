<?php

namespace App\Repositories;

use App\Models\Pagamento;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Facades\DB;



class PagamentoRepository extends BaseRepository implements TableInterface
{
    protected $model;


    public function __construct(
        Pagamento $model
    )
    {
        $this->model = $model;
    }

}