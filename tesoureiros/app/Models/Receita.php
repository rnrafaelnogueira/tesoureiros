<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    protected $table = 'receita';
    public $timestamps = true;
    protected $guarded = [];
    const CREATED_AT = 'data_cadastro';
    protected $dateFormat = 'Y-m-d H:i:s';
}
